<?php

namespace App\Http\Controllers\ToCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Financial;
use App\Model\Order;

class FinancialController extends Controller
{
    public function index(){
        if(auth()->user()->customer[0]->pivot->financial==0)
            return redirect()->back()->withStatusError("Access Denied");

        $financials = Financial::where('financial_cycle',date("Y-m-01"))
        ->where('customer_id', auth()->user()->customer[0]->id)
        ->get();

        $financial_total = Financial::where('financial_cycle',date("Y-m-01"))
        ->where('customer_id', auth()->user()->customer[0]->id)
        ->selectRaw('sum(item_conclusion_price) as financial_total_price')
        ->get()
        ->first();

        $cycle=date("Y.m");
        
        return view('app.toCustomer.financial.index', compact(['financials','financial_total','cycle']));
    }

    public function show(Request $request){
        if(auth()->user()->customer[0]->pivot->financial==0)
            return redirect()->back()->withStatusError("Access Denied");

        $cycle=$request->month_search;
        if(empty($cycle))
            $cycle=date("Y-m");

        $financials = Financial::where('financial_cycle',"$cycle-01")
        ->where('customer_id', auth()->user()->customer[0]->id)
        ->get();

        $financial_total = Financial::where('financial_cycle',"$cycle-01")
        ->where('customer_id', auth()->user()->customer[0]->id)
        ->selectRaw('sum(item_conclusion_price) as financial_total_price')
        ->get()
        ->first();

        $cycle=str_replace("-",".",$cycle);

        return view('app.toCustomer.financial.index', compact(['financials','financial_total','cycle']));
    }
}
