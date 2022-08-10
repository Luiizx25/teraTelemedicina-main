<?php

namespace App\Http\Controllers\ToCustomer\Order;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\LogOrder;
use App\Model\OrderItem;
use Carbon\Carbon;
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


    public function index(Request $request)
    {
        $now = Carbon::now();

        $data = $request->all();

        $date_start=date("Y-m-01");
        $date_end=date("Y-m-d");
        //
        // if ($data['cycleYear'] ?? false)
        //     $cycleYear = $data['cycleYear'];
        // else
        //     $cycleYear = $now->format('Y');

        //
        // if ($data['cycleMonth'] ?? false)
        //     $cycleMonth = $data['cycleMonth'];
        // else
        //     $cycleMonth = $now->format('m');

        //
        if (auth()->user()->id < 1000) {
            $customer = [];

            $orders = Order::where("created_at",">",date("Y-m-01 00:00:00"))->get();
            //
        } else {
            $user = auth()->user();

            if (!isset($user->customer[0]->id))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            // $orders = $customer->order;
            // $orders = $customer->order()->where("created_at",">",date("Y-m-01 00:00:00"))->get();
            $orders = OrderItem::
            join('tb_orders', 'tb_orders.id', '=', 'order_id')
            ->selectRaw('tb_orders_items.id as id, tb_orders_items.created_at as created_at, tb_orders_items.deleted_at as deleted_at, tb_orders_items.item_conclusion_datetime as item_conclusion_datetime, tb_orders_items.updated_at as updated_at, order_num, item_num, pat_name, pat_date_birth, item_service_id, item_status_id')
            ->with('status')
            ->with('service')
            ->with('files')
            ->where("tb_orders_items.created_at",">",date("Y-m-01 00:00:00"))
            ->where("tb_orders.customer_id","=",$user->customer[0]->id)
            ->orderBy('tb_orders_items.created_at', 'desc')
            ->get();
            // die(json_encode($orders));
        }

        // dd($orders[0]->itens->toArray());

        if (empty($orders))
            return redirect()->back()->withStatusWarning('Orders Not Found');

        return view('app.toCustomer.orderItem.index', compact( 'orders', 'date_start', 'date_end'));
    }

    public function search(Request $Request)
    {
        $date_start=$Request->date_start;
        $date_end=$Request->date_end;
        
        if (auth()->user()->id < 1000) {
            $customer = [];

            $orders = Order::whereBetween("created_at",["$date_start 00:00:00","$date_end 00:00:00"])->get();
            //
        } else {
            $user = auth()->user();

            if (!isset($user->customer[0]->id))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            // $orders = $customer->order;
            // $orders = $customer->order()->whereBetween("created_at",["$date_start 00:00:00","$date_end 00:00:00"])->get();
            $orders = OrderItem::
            join('tb_orders', 'tb_orders.id', '=', 'order_id')
            ->selectRaw('tb_orders_items.id as id, tb_orders_items.created_at as created_at, tb_orders_items.deleted_at as deleted_at, tb_orders_items.item_conclusion_datetime as item_conclusion_datetime, tb_orders_items.updated_at as updated_at, order_num, item_num, pat_name, pat_date_birth, item_service_id, item_status_id')
            ->with('status')
            ->with('service')
            ->with('files')
            ->whereBetween("tb_orders_items.created_at",["$date_start 00:00:00","$date_end 00:00:00"])
            ->where("tb_orders.customer_id","=",$user->customer[0]->id)
            ->orderBy('tb_orders_items.created_at', 'desc')
            ->get();
        }

        return view('app.toCustomer.orderItem.index', compact( 'orders', 'date_start', 'date_end'));
    }

    public function create($orderNum)
    {
        dd('CREATE');
    }

    public function store($orderNum, Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();

            $now = Carbon::now();

            $customer = auth()->user()->customer->first();

            if (empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $order = $customer->order()->whereOrderNum($orderNum)->first();

            // BAIXA SERVICO CYCLE
            $cycleService = $order->contractCycle->cycleService()->find($data['item_service_id']);
            $cycleService->cycle_amount_used      = ($cycleService->cycle_amount_used + 1);
            $cycleService->cycle_amount_available = ($cycleService->cycle_amount_available - 1);

            $price_service      = $cycleService->cycle_negotiated_price;
            $price_service_over = $cycleService->cycle_negotiated_price_over;
            $available          = $cycleService->cycle_amount_available - 1;

            $cycleService->save();

            // APPEND VALUES
            $data['item_conclusion_price']  = $available < 0 ? $price_service_over : $price_service; // VALOR
            $data['order_id']               = $order->id; // order
            $data['item_num']               = $order->patient_id; // patient
            $data['item_type_id']           = 1; // padrao
            $data['item_status_id']         = 10; // aguardando-anexos
            $data['item_service_id']        = $cycleService->service_id; // service By cycleService
            $data['service_variation_id']   = $data['service_variation_id'];

            $orderItem = $order->itens()->create($data);

            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $order->id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Exame criado"
            ]);

            DB::commit();

            // SE ACUIDADE VISUAL
            if ($orderItem->service->service_slug == "acuidade-visual")
                return redirect()->route('toCustomer.orderItem.show', ['orderNum' => $order->order_num, 'orderItem' => $orderItem->item_num]);

            return redirect()->route('toCustomer.order.show', ['order' => $order->order_num])->withStatusSuccess('Order item successfully created');
            //return redirect()->route('toCustomer.orderItem.show',['orderNum'=>$order->order_num,'orderItem'=>$orderItem->id])->withStatusSuccess('Order item successfully created');
            //
        } catch (\Throwable $th) {
            DB::rollBack();

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }

            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function show($orderNum, $orderItem)
    {
        $now = Carbon::now();

        if (auth()->user()->id < 1000) {
            $order = order::where('order_num', $orderNum)->first();

            $customer = $order->customer;
        } else {
            $customer = auth()->user()->customer->first();

            $order = $customer->order()->whereOrderNum($orderNum)->first();
        }

        if (empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        if (empty($order))
            return redirect()->back()->withStatusWarning('Order Not Found');

        $orderItem = $order->itens()->whereItemNum($orderItem)->first();

        if (empty($orderItem))
            return redirect()->back()->withStatusWarning('Order Item Not Found.');

        // dd($orderItem->service->toArray());

        // SE ACUIDADE VISUAL
        if ($orderItem->service->service_slug == "acuidade-visual")
            return view('app.toCustomer.orderItem.show-acuidade-visual', compact('customer', 'order', 'orderNum', 'orderItem'));

        return view('app.toCustomer.orderItem.show', compact('customer', 'order', 'orderNum', 'orderItem'));
    }

    public function showFile($orderNum, $orderItem, $fileId)
    {
        //var_dump($orderItem,$fileId);

        $customer = auth()->user()->customer->first();

        if (empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        $order = $customer->order()->whereOrderNum($orderNum)->first();

        if (empty($order))
            return redirect()->back()->withStatusWarning('Order Not Found');

        $orderItem = $order->itens()->whereItemNum($orderItem)->first();

        if (empty($orderItem))
            return redirect()->back()->withStatusWarning('Order Item Not Found.');

        $file = $orderItem->files->find($fileId);

        if (empty($file))
            return redirect()->back()->withStatusWarning('File Not Found.');

        //dd($orderItem->files);

        return view('app.file.view', compact('file'));
    }


    public function edit($id)
    {
        //
    }

    public function finalizeRegistration(Request $request, $orderNum, $orderItem)
    {
        try {
            DB::beginTransaction();

            $now = Carbon::now();

            $customer = auth()->user()->customer->first();

            if (empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $order = $customer->order()->whereOrderNum($orderNum)->first();

            if (empty($order))
                return redirect()->back()->withStatusWarning('Order Not Found');

            $orderItem = $order->itens()->find($orderItem);

            if (empty($orderItem))
                return redirect()->back()->withStatusWarning('Order Item Not Found..');

            $data = $request->all();

            // IF ITEM_FIELDS
            if ($data['item_fields'] ?? false) $data['item_fields'] = serialize($data['item_fields']);
            //
            $orderItem->item_fields = $data['item_fields'] ?? '{}';
            $orderItem->item_status_id = 15; // cadastrado
            $orderItem->item_conclusion_comment = null; // cadastrado
            $orderItem->save();

            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $order->id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Item cadastrado"
            ]);

            DB::commit();

            return redirect()->route('toCustomer.order.show', ['order' => $orderNum])->withStatusSuccess('Order item successfully registred');
            //
        } catch (\Throwable $th) {

            DB::rollBack();

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }

            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withStatusError(__($msg));
        }
    }

    public function finalizeCompleteReturn($orderNum, $orderItem)
    {
        try {
            DB::beginTransaction();

            $now = Carbon::now();

            $customer = auth()->user()->customer->first();

            if (empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $order = $customer->order()->whereOrderNum($orderNum)->first();

            if (empty($order))
                return redirect()->back()->withStatusWarning('Order Not Found');

            $orderItem = $order->itens()->find($orderItem);

            if (empty($orderItem))
                return redirect()->back()->withStatusWarning('Order Item Not Found..');

            $orderItem->item_status_id = 40; // aguardando atendimento
            $orderItem->item_conclusion_comment = null; // cadastrado
            $orderItem->save();
            
            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $order->id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Enviado para aguardando atendido"
            ]);

            DB::commit();

            return redirect()->route('toCustomer.order.show', ['order' => $orderNum])->withStatusSuccess('Order item successfully registred');
        } catch (\Throwable $th) {
            DB::rollBack();

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }

            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withStatusError(__($msg));
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $orderNum)
    {
        try {
            DB::beginTransaction();

            $now = Carbon::now();

            $data = $request->all();

            $customer = auth()->user()->customer->first();

            if (empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $order = $customer->order()->whereOrderNum($orderNum)->first();

            if (empty($order))
                return redirect()->back()->withStatusWarning('Order Not Found');

            $orderItem = $order->itens()->find($data['orderItem']);

            if (empty($orderItem))
                return redirect()->back()->withStatusWarning('Order Item Not Found...');

            $orderItem->item_status_id    = 30; // CANCELADO
            $orderItem->item_end_datetime = $now;
            $orderItem->item_conclusion_report_id   = null;
            $orderItem->item_conclusion_datetime    = $now;
            $orderItem->item_conclusion_provider_id = null;
            $orderItem->item_conclusion_comment     = 'Item cancelado pelo usuário ' . auth()->user()->name;
            $orderItem->save();

            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $order->id,
                "order_item_id" => $orderItem->id,
                "occurrence" => "Item cancelado pelo usuário"
            ]);
            // // APAGANDO ITEM FILES
            // if($orderItem->files->count())
            // {
            //     foreach($orderItem->files as $file)
            //     {
            //         // SE EXISTE APAGA ARQUIVOS FISICOS
            //         if(Storage::disk('public')->exists($file->file))
            //             Storage::disk('public')->delete($file->file);
            //         //
            //         $file->delete();
            //     }
            // }

            // // APAGANDO ITEM
            // $orderItem->delete();

            DB::commit();

            return redirect()->back()->withStatusSuccess('Order item successfully canceled');
        } catch (\Throwable $th) {
            DB::rollBack();

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }

            if (in_array($th->getCode(), [0]))
                $msg = $th->getMessage();
            else
                $msg = 'th' . $th->getCode();

            return redirect()->back()->withStatusError(__($msg));
        }
    }
}
