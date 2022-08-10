<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToCustomer\OrderRequest;
use App\Model\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order->get();

        //dd($orders->toArray());

        return view('app.toManager.order.index',compact('orders'));
    }

    public function create()
    {
        dd('create');
    }

    public function store(OrderRequest $request)
    {
        dd('store');
    }

    public function order()
    {
        dd('order');
    }

    public function show($orderNum)
    {
        $order = $this->order()->whereOrderNum($orderNum)->first();

        if(empty($order))
            return redirect()->back()->withStatusWarning('Order Not Found');

        $cycleServices = $order->contractCycle->cycleService;

        return view('app.toManager.order.show', compact('orderNum','order','cycleServices'));
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
                }
            }

            $order->status_id  = 70; // cancelado
            $order->deleted_at = $now;
            $order->save();

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
