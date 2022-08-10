<?php

namespace App\Http\Controllers\ToManager\Order;

use App\Http\Controllers\Controller;
use App\Model\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index(Request $Request)
    {
        //$orders = $this->order->where("created_at",">",date("Y-m-01 00:00:00"))->get();
        $orders = Order::with('status')
        ->with('itens')
        ->where("created_at",">",date("Y-m-01 00:00:00"))
        ->orderBy('created_at', 'desc')
        ->get();
        $date_start=date("Y-m-01");
        $date_end=date("Y-m-d");
        // if(auth()->user()->id == 1)
        // {
        //     TODO: /toManager/order?cycle=2021-09
        //     dd(
        //         $Request->all(),
        //         $orders->where('created_at')->toArray(),
        //     );
        // }
        //dd($orders->toArray());
        return view('app.toManager.order.index',compact('orders','date_start','date_end'));
    }

    public function search(Request $Request)
    {
        $date_start=$Request->date_start;
        $date_end=$Request->date_end;
        $orders = Order::with('status')
        ->with('itens')
        ->whereBetween("created_at",["$date_start 00:00:00","$date_end 00:00:00"])
        ->orderBy('created_at', 'desc')
        ->get();

        // if(auth()->user()->id == 1)
        // {
        //     TODO: /toManager/order?cycle=2021-09
        //     dd(
        //         $Request->all(),
        //         $orders->where('created_at')->toArray(),
        //     );
        // }

        //dd($orders->toArray());

        return view('app.toManager.order.index',compact('orders','date_start','date_end'));
    }

    public function show($orderNum)
    {
        $order = $this->order->whereOrderNum($orderNum)->first();

        if(empty($order))
            return redirect()->back()->withStatusWarning('Order Not Found');

        $cycleServices = $order->contractCycle->cycleService;

        return view('app.toManager.order.show', compact('orderNum','order','cycleServices'));
    }
}
