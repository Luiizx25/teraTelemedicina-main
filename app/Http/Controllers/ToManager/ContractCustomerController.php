<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ContractCustomerRequest;
use App\Model\ContractCustomer;
use App\Model\ListBoolean;
use App\Model\ListMonthDay;
use App\Model\RefContractCusType;
use App\Model\RefInvoicePayOption;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContractCustomerController extends Controller
{
    private $contractCustomer;

    public function __construct(ContractCustomer $contractCustomer)
    {
        $this->contractCustomer = $contractCustomer;
    }

    public function index()
    {
        $contracts = [];

        $customerSys = auth()->user()->customerSys->first();

        foreach ($this->contractCustomer->get() as $contract)
        {
            if($contract->customer->customer_sys_id != $customerSys->id)
                continue;

            $contracts[] = $contract;
        }

        //dd($this->contractCustomer->get(),$contracts);

        return view('customer.contract.index', compact('contracts'));
    }

    public function create(Request $request)
    {

        // GET CUSTOMERSYS
        $customerSys = auth()->user()->customerSys->first();

        // GET CUSTOMER
        $customer = $customerSys->customer()->whereCusSlug($request->input('customerSlug')??null)->first();

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        // GET CONTRACTS
        $contracts = $customer->ContractCustomer()->get();

        // SE EXITEM CONTRATOS - VALIDAR SE EXISTE CONTRATO EM ANDAMENTO
        if(false && $contracts->count())
        {
            dd('TODO - VALIDAR SE AINDA EM ABERTO',$request->all(), $customer, $contracts);
        }

        $ListBoolean = ListBoolean::all('id','ref_slug','ref_description');
        $ListMonthDay = ListMonthDay::all('id','ref_description');
        $RefContractCusType = RefContractCusType::all('id','ref_slug','ref_description');
        $RefInvoicePayOption = RefInvoicePayOption::all('id','ref_slug','ref_description');

        return view('customer.contract.create', compact('customer','contracts','RefContractCusType','RefInvoicePayOption','ListMonthDay','ListBoolean'));
    }

    public function store(ContractCustomerRequest $request)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CUSTOMER
            $customer = $customerSys->customer()->whereCusSlug($data['cus_slug']??null)->first();

            if(empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $data['customer_id'] = $customer->id;
            $data['contract_num'] = $customer->id;

            $contractCustomer = $customer->ContractCustomer()->create($data);

            //dd($data,$customer->ContractCustomer->toArray(),$contractCustomer->toArray());

            return redirect()->route('toManager.customerContract.show',['customerContract'=>$contractCustomer->contract_num])->withStatusSuccess('Contract successfully created');

        }
        catch (\Throwable $th)
        {

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

    public function show($contractNum)
    {
        // GET CUSTOMERSYS
        $customerSys = auth()->user()->customerSys->first();

        // GET CONTRACT
        $contract = $this->contractCustomer->whereContractNum($contractNum)->first();

        // NOT FOUND
        if(empty($contract))
            return redirect()->back()->withStatusWarning('Contract Not Found');

        // NO CUSTOMER SYS
        if($contract->customer->customer_sys_id != $customerSys->id)
            return redirect()->back()->withStatusError("No authorization to access this contract");

        $ListBoolean = ListBoolean::all('id','ref_description');

        //dd($contract->contractService);

        $now = Carbon::now();

        return view('customer.contract.show', compact('contract','ListBoolean','now'));
    }

    public function edit($contractNum, Request $request)
    {
        $data = $request->all();

        if($data['additive'] ?? false)
            $additive = true;
        else
            $additive = false;

        // GET CUSTOMERSYS
        $customerSys = auth()->user()->customerSys->first();

        // GET CONTRACT
        $contract = $this->contractCustomer->whereContractNum($contractNum)->first();

        // NOT FOUND
        if(empty($contract))
            return redirect()->back()->withStatusWarning('Contract Not Found');

        // NO CUSTOMER SYS
        if($contract->customer->customer_sys_id != $customerSys->id)
            return redirect()->back()->withStatusError("No authorization to access this contract");


        $ListBoolean = ListBoolean::all('id','ref_slug','ref_description');
        $ListMonthDay = ListMonthDay::all('id','ref_description');
        $RefContractCusType = RefContractCusType::all('id','ref_slug','ref_description');
        $RefInvoicePayOption = RefInvoicePayOption::all('id','ref_slug','ref_description');

        //dd($contract);

        return view('customer.contract.edit', compact('contract','additive','RefContractCusType','RefInvoicePayOption','ListMonthDay','ListBoolean'));
    }

    public function update(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();

            $now = Carbon::now();

            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $contractCustomer = $this->contractCustomer->find($id);

            // PEGA VERSAO ATUAL ANTES DA ALTERAÇÃO
            $contractOld = $contractCustomer->toArray();
            $contractOld['services'] = $contractCustomer->contractService->toArray();
            unset($contractOld['customer']);

            if(empty($contractCustomer))
                return redirect()->back()->withStatusWarning('Contract Not Found');

            if($contractCustomer->customer->customer_sys_id != $customerSys->id)
                return redirect()->back()->withStatusWarning('No authorization to access this contract');
                
            //
            $contractCustomer->update($data);

            //
            $contractNew  = $contractCustomer->toArray();
            $contractNew['services'] = $contractCustomer->contractService->toArray();
            unset($contractNew['customer']);

            // SE ADITIVO
            if($data['additive'] ?? false)
            {
                // VERIFICA SE VEIO DATA DO ADITIVO
                if(!$data['additive_date'])
                    return redirect()->back()->with('error','Data do aditivo precisa ser informada');

                // VALIDA DATA DO ADITIVO
                $additiveDate = new DateTime( $data['additive_date'] );

                // dd(
                //     $additiveDate->getTimestamp() <= $contractCustomer->contract_date->timestamp,
                //     $additiveDate->getTimestamp() >= $contractCustomer->contract_date_end->timestamp,
                //     $additiveDate->getTimestamp() > $now->timestamp,
                // );

                // SE DATA ADITIVO MENOR QUE ASSINATURA DO CONTRATO
                if( $additiveDate->getTimestamp() <= $contractCustomer->contract_date->timestamp )
                    return redirect()->back()->with('error','Data do aditivo deve ser maior que a assinatura do contrato');

                // SE DATA ADITIVO MENOR QUE A VIGENCIA DO CONTRATO
                if( $additiveDate->getTimestamp() >= $contractCustomer->contract_date_end->timestamp )
                    return redirect()->back()->with('error','Data do aditivo deve ser menor que o término do contrato');

                // SE DATA ADITIVO MENOR/IGUAL A HJ
                if( $additiveDate->getTimestamp() > $now->timestamp )
                    return redirect()->back()->with('error','Data do aditivo deve ser menor que hoje');

                $additiveData = [
                    'user_id'       => auth()->user()->id,
                    'additive_date' => $data['additive_date'],
                    'contract_id'   => $contractCustomer->id,
                    'contract_old'  => json_encode($contractOld),
                    'contract_new'  => json_encode($contractNew),
                    'additive_date_conciliation' => $now,
                ];
                
                $additive = $contractCustomer->Additives()->create($additiveData);

                DB::commit();

                return redirect()->route('toManager.customerContract.show',['customerContract'=>$contractCustomer->contract_num])->withStatusSuccess('Contrato aditivado com sucesso');
            }

            DB::commit();

            return redirect()->route('toManager.customerContract.show',['customerContract'=>$contractCustomer->contract_num])->withStatusSuccess('Contract successfully changed');
        }
        catch (\Throwable $th)
        {
            DB::rollBack();

            dd($th,__('code-'.$th->getCode()));

            if(in_array($th->getCode(),[0]))
                $msg = $th->getMessage();
            else
                $msg = 'th'.$th->getCode();

            return redirect()->back()->withStatusError(__($msg));
        }
    }
}
