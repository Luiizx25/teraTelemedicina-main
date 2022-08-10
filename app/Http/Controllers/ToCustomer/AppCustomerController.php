<?php

namespace App\Http\Controllers\ToCustomer;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\OrderItem;

class AppCustomerController extends Controller
{
    public function settings()
    {
        return view('app.toCustomer.settings');
    }

    public function dashboard()
    {
        $now      = Carbon::now();
        $ciclo    = $now->format('Y-m');
        $cicloAnt = $now->subMonth()->format('Y-m');
        $customer = auth()->user()->customer->first();

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');
        
        $orders=Order::where("customer_id",$customer->id)->where("created_at",">",date("Y-m-01 00:00:00"))->get();
        return view('app.toCustomer.dashboard',compact('now','ciclo','cicloAnt','customer','orders'));
    }
    

    public function dashboardFilter(Request $request)
    {

        $now      = Carbon::now();
        $ciclo    = $request->month_search;
        $cicloAnt = date('Y-m', strtotime("$ciclo -1 Month"));
        $cicloNxt = date('Y-m', strtotime("$ciclo +1 Month"));
        $customer = auth()->user()->customer->first();

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        $orders=Order::where("customer_id",$customer->id)->whereBetween("created_at",["$ciclo-01 00:00:00","$cicloNxt-01 00:00:00"])->get();
        return view('app.toCustomer.dashboard',compact('now','ciclo','cicloAnt','customer','orders'));
    }

    public function showFile($orderNum,$orderItem,$fileId)
    {
        //var_dump($orderItem,$fileId);

        $customer = auth()->user()->customer->first();

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        $order = $customer->order()->whereOrderNum($orderNum)->first();

        if(empty($order))
            return redirect()->back()->withStatusWarning('Order Not Found');

        $orderItem = $order->itens()->whereItemNum($orderItem)->first();

        if(empty($orderItem))
            return redirect()->back()->withStatusWarning('Order Item Not Found.');

        $file = $orderItem->files->find($fileId);

        if(empty($file))
            return redirect()->back()->withStatusWarning('File Not Found.');

        //dd($orderItem->files);

        return view('app.file.view',compact('file'));
    }
}
