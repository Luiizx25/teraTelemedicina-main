<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Model\Order;
use App\Model\OrderItem;
use Illuminate\Http\Request;

class AppCustomerSysController extends Controller
{
    public function index()
    {
        // VERIFICA SESSION POSSUI PERMISSÃO

        // SET SESSION PERFIL - TO MANAGER

        return view('app.toManager.dashboard');
    }

    public function settings()
    {
        return view('app.toManager.settings');
    }

    public function dashboard()
    {

        $now      = Carbon::now();
        $ciclo    = $now->format('Y-m');
        $cicloAnt = $now->subMonth()->format('Y-m');

        $customerSys = auth()->user()->customerSys->first();
        $itens = OrderItem::where("created_at",">",date("Y-m-01 00:00:00"))->get();
        //die(json_encode($customerSys));
        if(empty($customerSys))
            return redirect()->back()->withStatusWarning('CustomerSys Not Found');

        return view('app.toManager.dashboard',compact('now','ciclo','cicloAnt','customerSys','itens'));
    }

    public function dashboardFilter(Request $request)
    {

        $now      = Carbon::now();
        $ciclo    = $request->month_search;
        $cicloAnt = date('Y-m', strtotime("$ciclo -1 Month"));
        $cicloNxt = date('Y-m', strtotime("$ciclo +1 Month"));

        $customerSys = auth()->user()->customerSys->first();
        $itens = OrderItem::whereBetween("created_at",["$ciclo-01 00:00:00","$cicloNxt-01 00:00:00"])->get();
        //die(json_encode($customerSys));
        if(empty($customerSys))
            return redirect()->back()->withStatusWarning('CustomerSys Not Found');

        return view('app.toManager.dashboard',compact('now','ciclo','cicloAnt','customerSys','itens'));
    }
}
