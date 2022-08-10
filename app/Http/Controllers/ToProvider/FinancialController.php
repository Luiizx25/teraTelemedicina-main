<?php

namespace App\Http\Controllers\ToProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Financial;

class FinancialController extends Controller
{
    public function index(){
        if(auth()->user()->provider()===null)
            return redirect()->back()->withStatusError("Access Denied");

        $financials = Financial::where('financial_cycle',date("Y-m-01"))
        ->where('item_conclusion_provider_id',auth()->user()->provider->id)
        ->selectRaw('count(*) as total_items, service_name')
        ->groupBy('service_name')
        ->get();

        $cycle=date("Y.m");
        
        return view('app.toProvider.financial.index', compact(['financials','cycle']));
    }
    //
    public function show(Request $request){
        if(auth()->user()->provider()===null)
            return redirect()->back()->withStatusError("Access Denied");

        $cycle=$request->month_search;
        if(empty($cycle))
            $cycle=date("Y-m");

        $financials = Financial::where('financial_cycle',"$cycle-01")
        ->where('item_conclusion_provider_id',auth()->user()->provider->id)
        ->selectRaw('count(*) as total_items, service_name')
        ->groupBy('service_name')
        ->get();

        $cycle=str_replace("-",".",$cycle);
        
        return view('app.toProvider.financial.index', compact(['financials','cycle']));
    }
    //
}
