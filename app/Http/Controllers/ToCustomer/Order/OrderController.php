<?php

namespace App\Http\Controllers\ToCustomer\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToCustomer\OrderRequest;
use App\Model\Order;
use App\Model\LogOrder;
use App\Model\RefOrderType;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;

class OrderController extends Controller
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $date_start=date("Y-m-01");
        $date_end=date("Y-m-d");
        if(auth()->user()->id < 1000)
        {
            $orders = Order::all();
        }
        else
        {
            $user     = auth()->user();
            // $customer = $user->customer->first();
            // $orders   = $customer->order->where("created_at",">",date("Y-m-01 00:00:00"));
            $orders = Order::with('status')
            ->with('itens')
            ->where("customer_id","=",$user->customer[0]->id)
            ->where("created_at",">",date("Y-m-01 00:00:00"))
            ->orderBy('created_at', 'desc')
            ->get();
            // die(json_encode($orders));
        }

        return view('app.toCustomer.order.index',compact('orders','date_start','date_end'));
    }
    

    public function search(Request $Request)
    {
        $date_start=$Request->date_start;
        $date_end=$Request->date_end;
        if(auth()->user()->id < 1000)
        {
            $orders = Order::all();
        }
        else
        {
            $user     = auth()->user();
            // $customer = $user->customer->first();
            // $orders   = $customer->order->whereBetween("created_at",["$date_start 00:00:00","$date_end 00:00:00"]);
            $orders = Order::with('status')
            ->with('itens')
            ->where("customer_id","=",$user->customer[0]->id)
            ->whereBetween("created_at",["$date_start 00:00:00","$date_end 00:00:00"])
            ->orderBy('created_at', 'desc')
            ->get();
        }

        return view('app.toCustomer.order.index',compact('orders','date_start','date_end'));
    }

    public function create()
    {
        $now = Carbon::now();
        $idControle = $now->getTimestamp();

        $user     = auth()->user();
        $customer = $user->customer->first();

        if(empty($customer))
            throw new Exception('Customer Not Found');

        $contract = $customer->ContractCustomer()->whereActive(true)
                        ->where('contract_date_start','<=',$now)
                        ->where('contract_date_end','>=',$now)
                        ->first();

        if(empty($contract))
            return redirect()->back()->withStatusWarning('Contract Not Found');

        $cycle = $contract->contractCycle()->whereCycleSlug($now->format('Y-m'))->first();

        if(empty($cycle))
            return redirect()->back()->withStatusWarning('Contract Cycles Not Found');

        $cycleServices = $cycle->cycleService;

        if(empty($cycleServices))
            return redirect()->back()->withStatusWarning('No services registered for this customer current contract');

        $RefOrderType = RefOrderType::all('id','ref_description');

        return view('app.toCustomer.order.create', compact('idControle','customer','RefOrderType'));
    }

    public function store(OrderRequest $request)
    {
        try
        {
            DB::beginTransaction();

            $now = Carbon::now();

            $user     = auth()->user();
            $customer = $user->customer->first();

            if(empty($customer))
                throw new Exception('Customer Not Found');

            $data = $request->all();
            $data['user_id']   = (int) $user->id;

            // GET PATIENT
            $patient = $customer->patient()->wherePatDocType(strtoupper($data['pat_doc_type']))->wherePatDocNum($data['pat_doc_num'])->first();

            // IF PATIENT
            if($patient)
                $patient->update($data); // UPDATE USER
            else
                $patient = $customer->patient()->create($data); // NEW USER

            $contract = $customer->ContractCustomer()->whereActive(true)
                            ->where('contract_date_start','<=',$now)
                            ->where('contract_date_end','>=',$now)
                            ->first();

            if(empty($contract))
                throw new Exception('Contract Not Found');

            $cycle = $contract->contractCycle()->whereCycleSlug($now->format('Y-m'))->first();

            if(empty($cycle))
                throw new Exception('Contract Cycles Not Found');

            // NEW ORDER
            $data['order_num']  = (int) $customer->id; // TRAID >> NUM GER
            $data['patient_id'] = (int) $patient->id;
            $data['type_id']    = (int)  1; // laudo
            $data['status_id']  = (int) 10; // paciente-qualificado
            $data['status_id']  = (int) 30; // aguardando-itens
            $data['status_id']  = (int) 40; // inserindo-itens
            $data['contract_cycle_id'] = $cycle->id;

            // VERIFICA SE EXISTE ORDEM DESSE USUARIO NOS STATUS = 1 - paciente-qualificado / 2 - revisando-paciente / 3 - aguardando-itens / 4 - inserindo-itens / 5 - revisando-itens
            //$ordersUnfinished = $customer->order()->whereUserId($user->id)->whereIn('status_id', [1,2,3,4,5])->get();
            //
            //if($ordersUnfinished->count())
            //    throw new Exception('There are unfinished orders this user');

            //dd($patient,$data);

            // CREATE ORDER
            $order = $customer->order()->create($data);

            LogOrder::create([
                "user_id" => (int) $user->id,
                "order_id" => $order->id,
                "order_item_id" => null,
                "occurrence" => "Pedido criado"
            ]);

            DB::commit();

            return redirect()->route('toCustomer.order.show',['order'=>$order->order_num])->withStatusSuccess('Order successfully created');
        }
        catch (\Throwable $th)
        {
            DB::rollBack();

            dd($th,__('code-'.$th->getCode()));

            if(in_array($th->getCode(),[0]))
                $msg = $th->getMessage();
            else
                $msg = 'th'.$th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function show($orderNum)
    {
        $now = Carbon::now();

        $idControle = $now->getTimestamp();

        if(auth()->user()->id < 1000)
        {
            $order = order::where('order_num',$orderNum)->first();

            $customer = $order->customer;
        }
        else
        {
            $customer = auth()->user()->customer->first();

            $order = $customer->order()->whereOrderNum($orderNum)->first();
        }

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');
        
        if(empty($order))
            return redirect()->back()->withStatusWarning('Order Not Found');

        $cycleServices = $order->contractCycle->cycleService;

        return view('app.toCustomer.order.show', compact('idControle','customer','orderNum','order','cycleServices'));
    }

    public function confirm($orderNum)
    {
        try
        {
            DB::beginTransaction();

            $now = Carbon::now();

            $customer = auth()->user()->customer->first();

            if(empty($customer))
                throw new Exception('Customer Not Found');

            $order = $customer->order()->whereOrderNum($orderNum)->first();

            if(empty($order))
                throw new Exception('Order Not Found');

            if($order->status_id == 70)
                throw new Exception('Order is canceled');

            if($order->status_id > 70)
                throw new Exception('Order is already in service');

            if(empty($order->itens->count()))
                throw new Exception('Order has no items');

            if($order->itens()->whereItemStatusId(10)->count()) // 10 = aguardando anexos
                throw new Exception('There are items waiting for attachments');

            $order->itens()->whereIn('item_status_id',[15])->whereNotIn('item_status_id',[30])->update(['item_status_id' => 40]); // 15 = cadastrado / 30 = cancelado / 40 = aguardando atendimento

            $order->update(['status_id' => 90]); // 90 = aguardando atendimento

            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $order->id,
                "order_item_id" => null,
                "occurrence" => "Itens enviados para atendimento"
            ]);

            DB::commit();

            return redirect()->route('toCustomer.order.show',['order'=>$orderNum])->withStatusSuccess('Order completed successfully');
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

    public function edit($id)
    {
        echo "edit";
    }

    public function update(Request $request, $id)
    {
        echo "update";
    }

    public function destroy($orderNum)
    {
        try
        {
            DB::beginTransaction();

            $now = Carbon::now();

            $customer = auth()->user()->customer->first();

            if(empty($customer))
                throw new Exception('Customer Not Found');

            $order = $customer->order()->whereOrderNum($orderNum)->first();

            if(empty($order))
                throw new Exception('Order Not Found');

            if(!empty($order->deleted_at))
                throw new Exception('Order is already canceled');

            if($order->status_id > 90) // 90 = aguardando atendimento
                throw new Exception('Order cannot be canceled because it is already being fulfilled');

            if($order->itens->count())
            {
                foreach ($order->itens as $item)
                {
                    if($item->item_status_id > 40) // 40 = aguardando atendimento
                    throw new Exception('Order cannot be canceled. There are items in service');

                    $item->deleted_at     = $now;
                    $item->item_status_id = 30; // cancelado
                    $item->save();
                    
                    LogOrder::create([
                        "user_id" => auth()->user()->id,
                        "order_id" => $order->id,
                        "order_item_id" => $item->id,
                        "occurrence" => "Exame cancelado"
                    ]);
                }
            }

            $order->status_id  = 70; // cancelado
            $order->deleted_at = $now;
            $order->save();
            
            LogOrder::create([
                "user_id" => auth()->user()->id,
                "order_id" => $order->id,
                "order_item_id" => null,
                "occurrence" => "Pedido cancelado"
            ]);

            DB::commit();

            return redirect()->back()->withStatusSuccess('Order successfully canceled');
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
