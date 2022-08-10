<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSys\ContractProviderRequest;
use App\Model\ContractProvider;
use App\Model\ListMonthDay;
use App\Model\RefContractPvdType;
use App\Model\RefPaymentPvdOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractProviderController extends Controller
{
    private $contractProvider;

    public function __construct(ContractProvider $contractProvider)
    {
        $this->contractProvider = $contractProvider;
    }

    public function index()
    {
        $contracts = [];

        $customerSys = auth()->user()->customerSys->first();

        foreach ($this->contractProvider->get() as $contract)
        {
            if($contract->provider->customer_sys_id != $customerSys->id)
                continue;

            $contracts[] = $contract;
        }

        //dd($this->contractCustomer->get(),$contracts);

        return view('customerSys.provider.contract.index', compact('contracts'));
    }

    public function create(Request $request)
    {
        // GET CUSTOMERSYS
        $customerSys = auth()->user()->customerSys->first();

        // GET CUSTOMER
        $provider = $customerSys->provider()->wherePvdSlug($request->input('providerSlug')??null)->first();

        if(empty($provider))
            return redirect()->back()->withStatusWarning('Provider Not Found');

        // SE EXITEM CONTRATOS - VALIDAR SE EXISTE CONTRATO EM ANDAMENTO
        if(false && $provider->ContractProvider->count())
        {
            dd('TODO - VALIDAR SE AINDA EM ABERTO',$request->all(), $provider, $provider->ContractProvider);
        }

        $ListMonthDay = ListMonthDay::all('id','ref_description');
        $RefContractPvdType = RefContractPvdType::all('id','ref_slug','ref_description');
        $RefPaymentPvdOption = RefPaymentPvdOption::all('id','ref_slug','ref_description');

        //dd($request->all(),$provider);

        return view('customerSys.provider.contract.create', compact('provider','RefContractPvdType','RefPaymentPvdOption','ListMonthDay'));
    }

    public function store(ContractProviderRequest $request)
    {
        try
        {
            DB::beginTransaction();

            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CUSTOMER
            $provider = $customerSys->provider()->wherePvdSlug($data['pvd_slug']??null)->first();

            if(empty($provider))
                return redirect()->back()->withStatusWarning('Provider Not Found');

            // PARSE TEMPORARIO PARA A TRAIT
            $data['contract_num'] = $provider->id;

            $contractProvider = $provider->ContractProvider()->create($data);

            //dd($contractProvider);

            DB::commit();

            return redirect()->route('toManager.providerContract.show',['providerContract'=>$contractProvider->contract_num])->withStatusSuccess('Contract successfully created');

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

    public function show($contractNum)
    {
        // GET CUSTOMERSYS
        $customerSys = auth()->user()->customerSys->first();

        // GET CONTRACT
        $contract = $this->contractProvider->whereContractNum($contractNum)->first();

        // NOT FOUND
        if(empty($contract))
            return redirect()->back()->withStatusWarning('Contract Not Found');

        // NO CUSTOMER SYS
        if($contract->provider->customer_sys_id != $customerSys->id)
            return redirect()->back()->withStatusError("No authorization to access this contract");

        //dd($contract);

        $now = Carbon::now();

        return view('customerSys.provider.contract.show', compact('contract','now'));
    }

    public function edit($contractNum)
    {
        // GET CUSTOMERSYS
        $customerSys = auth()->user()->customerSys->first();

        // GET CONTRACT
        $contract = $this->contractProvider->whereContractNum($contractNum)->first();

        // NOT FOUND
        if(empty($contract))
            return redirect()->back()->withStatusWarning('Contract Not Found');

        // NO CUSTOMER SYS
        if($contract->provider->customer_sys_id != $customerSys->id)
            return redirect()->back()->withStatusError("No authorization to access this contract");

        $ListMonthDay = ListMonthDay::all('id','ref_description');
        $RefContractPvdType = RefContractPvdType::all('id','ref_slug','ref_description');
        $RefPaymentPvdOption = RefPaymentPvdOption::all('id','ref_slug','ref_description');

        //dd($contract);

        return view('customerSys.provider.contract.edit', compact('contract','RefContractPvdType','RefPaymentPvdOption','ListMonthDay'));
    }

    public function update(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();

            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $contractProvider = $this->contractProvider->find($id);

            if(empty($contractProvider))
                return redirect()->back()->withStatusWarning('Contract Not Found');

            if($contractProvider->provider->customer_sys_id != $customerSys->id)
                return redirect()->back()->withStatusWarning('No authorization to access this contract');

            $contractProvider->update($data);

            DB::commit();

            return redirect()->route('toManager.providerContract.show',['providerContract'=>$contractProvider->contract_num])->withStatusSuccess('Contract successfully changed');
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
