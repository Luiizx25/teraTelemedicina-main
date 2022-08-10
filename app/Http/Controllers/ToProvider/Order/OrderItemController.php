<?php

namespace App\Http\Controllers\ToProvider\Order;

use App\Http\Controllers\Controller;
use App\Model\OrderItem;
use App\Model\OrderItemReport;
use App\Model\Provider;
use App\Model\ContractProvider;
use Carbon\Carbon;
use App\Model\LogOrder;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderItemController extends Controller
{
    private $orderItem;

    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    public function index()
    {
        $now = Carbon::now();

        $provider = auth()->user()->provider;

        //dd($provider);

        if(empty($provider))
            return redirect()->back()->withStatusWarning('provider Not Found');

        $orders = $provider->order;

        $OrderItemReports = $provider->OrderItemReports->whereIn('report_status_id',[10]); // 10.Laudo concluído assinado

        return view('app.toProvider.Order.Item.index', compact('provider','OrderItemReports'));
    }

    public function show($orderItemNum, $reportId)
    {
        $now = Carbon::now();

        $provider = auth()->user()->provider;

        if(empty($provider))
            return redirect()->back()->withStatusWarning('Provider Not Found');

        $report = $provider->OrderItemReports->find($reportId);

        if(empty($report))
            return redirect()->back()->withStatusWarning('Report Not Found');

        //dd($orderItemNum, $reportId, $report);

        return view('app.toProvider.Order.Item.report.show', compact('provider','reportId','report','now'));
    }

    public function answer(Request $request, $serviceSlug=false)
    {
        try
        {
            DB::beginTransaction();

            $now = Carbon::now();

            $providers = false;
            $simulated = false;

            if(auth()->user()->id < 1000)
            {
                if($request->input('providerSlug'))
                {
                    $simulated  = true;
                    $providers  = false;
                    $provider   = Provider::where('pvd_slug',$request->input('providerSlug'))->first();
                    $contract   = $provider->ContractProvider()->whereActive(true)
                                        ->where('contract_date_start','<=',$now)
                                        ->where('contract_date_end','>=',$now)
                                        ->first();
                }
                else
                {
                    $simulated  = false;
                    $providers  = Provider::all();
                    $provider   = [];
                    $contract   = [];                    
                }
            }
            else
            {
                $provider = auth()->user()->provider;

                if(empty($provider))
                    return redirect()->back()->withStatusWarning('provider Not Found');

                $contract = $provider->ContractProvider()->whereActive(true)
                                ->where('contract_date_start','<=',$now)
                                ->where('contract_date_end','>=',$now)
                                ->first();
    
                if(empty($contract))
                    return redirect()->back()->withStatusWarning('Contract Not Found');
            }

            if($serviceSlug??false)
            {
                $contractService = $contract->contractService->where('service.service_slug',$serviceSlug)->first();

                if(!$contractService)
                    return redirect()->route('toProvider.orderItem.answer')->withStatusError('Service selected not found in your contract');

                $orderItem="";
                $orderItems=$contractService->service->orderItem->whereIn('item_status_id',[40]);
                foreach($orderItems as $orderItemAnalise){
                    if($orderItemAnalise->reports->where('provider_id',$provider->id)->where('report_status_id',6)->first()){
                        //continue
                    }
                    else{
                        $orderItem=$orderItemAnalise;
                        break;
                    }
                }
                // if($orderItem = $contractService->service->orderItem->whereIn('item_status_id',[40])->first()) // 40 - aguardando-atendimento
                if($orderItem)
                {
                    // INICIA REPORT
                    $report = OrderItemReport::create(
                        [
                            'item_id'           => $orderItem->id,
                            'provider_id'       => $provider->id,
                            'report_type_id'    => 1, // 1.LEGENDA
                            'report_status_id'  => 1, // 1.INICIADO
                            'report_conclusion' => 'Laudo iniciado',
                            'report_comments'   => 'Laudo iniciado em '.$now->format('d/m/Y H:i'),
                        ]
                    );

                    //
                    $itemStatusId = 50; // 50.Em-atendimento

                    //
                    $orderItem->item_status_id_ant = ( $orderItem->item_status_id == $itemStatusId?$orderItem->item_status_id_ant : $itemStatusId ); // SALVA ID ANTERIOR
                    $orderItem->item_status_id = $itemStatusId;
                    $orderItem->item_start_datetime = $now;
                    $orderItem->item_conclusion_provider_id = $provider->id;
                    $orderItem->item_conclusion_report_id = $report->id;
                    $orderItem->save();
                    //
                    $orderItem->order->status_id = 100; // em-atendimento
                    $orderItem->order->save();

                    LogOrder::create([
                        "user_id" => auth()->user()->id,
                        "order_id" => $orderItem->order->id,
                        "order_item_id" => $orderItem->id,
                        "occurrence" => "Atendimento iniciado"
                    ]);

                    DB::commit();

                    if($simulated && $request->input('providerSlug'))
                        return redirect()->route('toProvider.orderItem.report.process',['orderItemNum'=>$orderItem->item_num,'providerSlug' => $request->input('providerSlug')]);
                    else
                        return redirect()->route('toProvider.orderItem.report.process',['orderItemNum'=>$orderItem->item_num]);
                }

                return redirect()->back()->withStatusWarning('No orders in queue');
            }

            return view('app.toProvider.Order.Item.answer', compact('contract','provider','providers','simulated'));
        }
        catch (\Throwable $th)
        {
            DB::rollBack();

            if(env('APP_DEBUG') && auth()->user()->id < 1000)
            {
                report($th);
                
                dd($th,__('code-'.$th->getCode()));
            }

            if(in_array($th->getCode(),[0]))
                $msg = $th->getMessage();
            else
                $msg = 'th'.$th->getCode();

            return redirect()->back()->withStatusError(__($msg));
        }
    }

    public function reopen($itemNum=false)
    {
        try
        {
            DB::beginTransaction();

            $now = Carbon::now();

            $provider = auth()->user()->provider()->first();

            if(empty($provider))
                return redirect()->back()->withStatusWarning('provider Not Found');

            $orderItem = $this->orderItem->whereItemNum($itemNum)->first();

            if(empty($orderItem))
                return abort(404,'Order item not found');

            if(!in_array($orderItem->item_status_id,[90]))
                return abort(404,__('Order item cannot be reopened')." - statusCod. {$orderItem->item_status_id}");

            if(auth()->user()->id > 999)
            {
                if($orderItem->item_conclusion_provider_id && $orderItem->item_conclusion_provider_id != auth()->user()->provider->id)
                    abort(404,'Item já está atribuido a outro usuário');
            }

            // INICIA REPORT
            $report = OrderItemReport::create(
                [
                    'item_id'           => $orderItem->id,
                    'provider_id'       => $provider->id,
                    'report_type_id'    => 1, // 1.legenda
                    'report_status_id'  => 5, // 5.em-revisao
                    'report_conclusion' => 'Laudo em revisão',
                    'report_comments'   => 'Revisão do laudo em '.$now->format('d/m/Y H:i'),
                    'report_results'    => $orderItem->ConclusionReport->report_results??null,
                ]
            );

            //
            $itemStatusId = 40; // 80.em-revisao-provedor
            //
            $orderItem->item_status_id_ant = ( $orderItem->item_status_id == $itemStatusId?$orderItem->item_status_id_ant : $itemStatusId ); // SALVA ID ANTERIOR
            $orderItem->item_status_id = $itemStatusId;
            $orderItem->item_start_datetime = $now;
            $orderItem->item_conclusion_provider_id = $provider->id;
            $orderItem->item_conclusion_report_id = $report->id;
            $orderItem->save();
            
            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $orderItem->order->id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Em revisão do provedor"
            ]);

            DB::commit();

            return redirect()->route('toProvider.orderItem.report.process',['orderItemNum'=>$orderItem->item_num]);
        }
        catch (\Throwable $th)
        {
            DB::rollBack();

            if(env('APP_DEBUG') && auth()->user()->id < 1000)
            {
                report($th);
                
                dd($th,__('code-'.$th->getCode()));
            }


            if(in_array($th->getCode(),[0]))
                $msg = $th->getMessage();
            else
                $msg = 'th'.$th->getCode();

            return redirect()->back()->withStatusError(__($msg));
        }
    }
}
