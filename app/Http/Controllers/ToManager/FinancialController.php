<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Financial;

class FinancialController extends Controller
{
    public function index(){
        if(auth()->user()->admin_financial==0)
            return redirect()->back()->withStatusError("Access Denied");

        //SELECT DAS CLINICAS
        $customers=Customer::selectRaw('id,cus_name')
        ->get();
        
        // REGISTROS DO FINANCEIRO
        $financials = Financial::where('financial_cycle',date("Y-m-01"))
        ->join('tb_customers', 'tb_customers.id', '=', 'customer_id')
        ->selectRaw('count(*) as total_items, service_name, cus_name, item_conclusion_price')
        ->groupBy('service_name')
        ->groupBy('cus_name')
        ->groupBy('item_conclusion_price')
        ->get();

        //organizando informações dos exames das clinicas
        //resultado em json: { "cus_name": "clinica Yan", "total_price" : "30.00", "total_items" : "5", items : [ { "service_name" : "exame 1", "item_qtd" : "3" }, { "service_name" : "exame 2", "item_qtd" : "2" } ] }
        $financial_items=[];
        foreach($financials as $financial){
            $index=$this->getIndex($financial->cus_name,$financial_items);
            if($index===false){
                $financial_items[] = array(
                    "cus_name" => $financial->cus_name,
                    "total_price" => $financial->item_conclusion_price * $financial->total_items,
                    "total_items" => $financial->total_items,
                    "items" => array()
                );
                $financial_items[count($financial_items)-1]["items"][] =array(
                    "service_name" => $financial->service_name,
                    "item_qtd" => $financial->total_items
                );
            }
            else{
                $financial_items[$index]["total_price"] += $financial->item_conclusion_price * $financial->total_items;
                $financial_items[$index]["total_items"] += $financial->total_items;
                $financial_items[$index]["items"][] = array(
                    "service_name" => $financial->service_name,
                    "item_qtd" => $financial->total_items
                );
            }
        }
        // VALOR TOTAL
        $financial_total = Financial::where('financial_cycle',date("Y-m-01"))
        ->selectRaw('sum(item_conclusion_price) as financial_total_price')
        ->join('tb_customers', 'tb_customers.id', '=', 'customer_id')
        ->get()
        ->first();
        $cycle=date("Y.m");
        $customer_name="";
        return view('app.toManager.financial.index', compact(['customers','financial_items','financial_total','cycle','customer_name']));
    }
    
    public function show(Request $request){
        if(auth()->user()->admin_financial==0)
            return redirect()->back()->withStatusError("Access Denied");

        $cycle=$request->month_search;
        if(empty($cycle))
            $cycle=date("Y-m");
        $customer_name=$request->customer_name;
        // BUSCAR DE TODAS AS CLÍNICAS
        if(empty($customer_name)){
            $customers=Customer::selectRaw('id,cus_name')
            ->get();
            
            $financials = Financial::where('financial_cycle',"$cycle-01")
            ->join('tb_customers', 'tb_customers.id', '=', 'customer_id')
            ->selectRaw('count(*) as total_items, service_name, cus_name, item_conclusion_price')
            ->groupBy('service_name')
            ->groupBy('cus_name')
            ->groupBy('item_conclusion_price')
            ->get();

            $financial_total = Financial::where('financial_cycle',"$cycle-01")
            ->selectRaw('sum(item_conclusion_price) as financial_total_price')
            ->join('tb_customers', 'tb_customers.id', '=', 'customer_id')
            ->get()
            ->first();
        }
        // BUSCAR DA CLÍNICA SELECIONADA
        else{
            $customers=Customer::selectRaw('id,cus_name')
            ->get();
            
            $financials = Financial::where('financial_cycle',"$cycle-01")
            ->where('customer_id',$customer_name)
            ->join('tb_customers', 'tb_customers.id', '=', 'customer_id')
            ->selectRaw('count(*) as total_items, service_name, cus_name, item_conclusion_price')
            ->groupBy('service_name')
            ->groupBy('cus_name')
            ->groupBy('item_conclusion_price')
            ->get();

            $financial_total = Financial::where('financial_cycle',"$cycle-01")
            ->where('customer_id',$customer_name)
            ->selectRaw('sum(item_conclusion_price) as financial_total_price')
            ->join('tb_customers', 'tb_customers.id', '=', 'customer_id')
            ->get()
            ->first();
        }
        $cycle=str_replace("-",".",$cycle);
        
        //organizando informações dos exames das clinicas
        //resultado em json: { "cus_name": "clinica Yan", "total_price" : "30.00", "total_items" : "5", items : [ { "service_name" : "exame 1", "item_qtd" : "3" }, { "service_name" : "exame 2", "item_qtd" : "2" } ] }
        $financial_items=[];
        foreach($financials as $financial){
            $index=$this->getIndex($financial->cus_name,$financial_items);
            if($index===false){
                $financial_items[] = array(
                    "cus_name" => $financial->cus_name,
                    "total_price" => $financial->item_conclusion_price * $financial->total_items,
                    "total_items" => $financial->total_items,
                    "items" => array()
                );
                $financial_items[count($financial_items)-1]["items"][] =array(
                    "service_name" => $financial->service_name,
                    "item_qtd" => $financial->total_items
                );
            }
            else{
                $financial_items[$index]["total_price"] += $financial->item_conclusion_price * $financial->total_items;
                $financial_items[$index]["total_items"] += $financial->total_items;
                $financial_items[$index]["items"][] = array(
                    "service_name" => $financial->service_name,
                    "item_qtd" => $financial->total_items
                );
            }
        }

        return view('app.toManager.financial.index', compact(['customers','financial_items','financial_total','cycle','customer_name']));
    }

    
    private function getIndex($cus_name,$financial_items){
        $cus_names = array_column($financial_items, 'cus_name');
        $index = array_search($cus_name, $cus_names);
        return $index;
    }
}
