<?php

namespace App\Http\Controllers\ToManager\Order;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\LogOrder;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    private $orderItem;

    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    public function index()
    {
        $orderItens = OrderItem::
        with('order')
        ->with('status')
        ->with('service')
        ->with('files')
        ->where("created_at",">",date("Y-m-01 00:00:00"))
        ->orderBy('created_at', 'desc')
        ->get();
        $date_start=date("Y-m-01");
        $date_end=date("Y-m-d");

        //dd($orderItens->toArray());

        return view('app.toManager.orderItem.index',compact('orderItens','date_start','date_end'));
    }
    
    public function search(Request $Request)
    {
        $date_start=$Request->date_start;
        $date_end=$Request->date_end;
        $orderItens = OrderItem::
        with('order')
        ->with('status')
        ->with('service')
        ->with('files')
        ->whereBetween("created_at",["$date_start 00:00:00","$date_end 00:00:00"])
        ->orderBy('created_at', 'desc')
        ->get();

        //dd($orderItens->toArray());

        return view('app.toManager.orderItem.index',compact('orderItens','date_start','date_end'));
    }

    public function show($itemNum)
    {
        $orderItem = $this->orderItem->whereItemNum($itemNum)->first();

        if(empty($orderItem))
            return redirect()->back()->withStatusWarning('Item Not Found');

        $order = $orderItem->order;

        $logs = LogOrder::with('user')
        ->where('order_item_id',$orderItem->id)
        ->get();

        return view('app.toManager.orderItem.show', compact('itemNum','orderItem','order','logs'));
    }
}
