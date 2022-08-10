<?php

namespace App\Http\Controllers\ToCustomer\Patient;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Patient;

class PatientController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $customer = auth()->user()->customer->first();

        // dd(
        //     $customer->pivot->toArray(),
        //     $customer->toArray(),
        //     auth()->user()->toArray(),
        //     auth()->user()->customer->toArray(),
        // );

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        // $patients = $customer->patient;
        $patients = Patient::where("customer_id","=",$customer->id)
        ->take(25)
        ->orderBy("created_at","desc")
        ->get();

        if(empty($patients))
            return redirect()->back()->withStatusWarning('Patients Not Found');

        return view('app.toCustomer.patient.index', compact('customer','patients'));
    }

    public function search(Request $request){
        $now = Carbon::now();

        $cpf=str_replace("_","",$request->doc_num);
        $verificar=1;
        while($verificar==1){
            if(substr($cpf,-1)=="." || substr($cpf,-1)=="-")
                $cpf = substr($cpf, 0, -1);
            else
                $verificar=0;
        }
        
        $customer = auth()->user()->customer->first();

        // dd(
        //     $customer->pivot->toArray(),
        //     $customer->toArray(),
        //     auth()->user()->toArray(),
        //     auth()->user()->customer->toArray(),
        // );

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        // $patients = $customer->patient;
        $patients = Patient::where("customer_id","=",$customer->id)
        ->where('pat_doc_num', 'like', "%$cpf%")
        ->take(25)
        ->orderBy("created_at","desc")
        ->get();

        if(empty($patients))
            return redirect()->back()->withStatusWarning('Patients Not Found');

        return view('app.toCustomer.patient.index', compact('customer','patients'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        dd($id);
    }

    public function showByDoc($docType,$docNum)
    {
        $now = Carbon::now();

        $customer = auth()->user()->customer->first();

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        $patient = $customer->patient()->wherePatDocType($docType)->wherePatDocNum($docNum)->first();

        if(empty($patient))
            return redirect()->back()->withStatusWarning('Patient Not Found');

        return view('app.toCustomer.patient.show', compact('customer','patient'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
