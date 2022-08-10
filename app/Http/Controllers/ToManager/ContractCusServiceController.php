<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\ContractCusService;
use App\Model\ContractCustomer;
use Illuminate\Http\Request;

class ContractCusServiceController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CONTRACT
            $contract = ContractCustomer::whereContractNum($data['contract_num'])->first();

            // NOT FOUND
            if(empty($contract))
                return redirect()->back()->withStatusWarning('Contract Not Found');

            // NO CUSTOMER SYS
            if($contract->customer->customer_sys_id != $customerSys->id)
                return redirect()->back()->withStatusError("No authorization to access this contract");

            $data['contract_id'] = $contract->id;

            $contractService = $contract->contractService()->create($data);

            //dd($contractService, $data,$contract,$contract->customer->customer_sys_id , $customerSys->id);

            return redirect()->back()->withServiceSuccess(__("Service successfully added to contract"));
        }
        catch (\Throwable $th)
        {

            if(env('APP_DEBUG') && auth()->user()->id < 1000)
            {
                report($th);
                
                dd($th,__('code-'.$th->getCode()));
            }

            return redirect()->back()->withInput($request->all())->withServiceError(__('th'.$th->getCode()));
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CONTRACT
            $contract = ContractCustomer::whereContractNum($data['contract_num'])->first();

            // NOT FOUND
            if(empty($contract))
                return redirect()->back()->withStatusWarning('Contract Not Found');

            // NO CUSTOMER SYS
            if($contract->customer->customer_sys_id != $customerSys->id)
                return redirect()->back()->withStatusError("No authorization to access this contract");

            $contractService = ContractCusService::whereId($id)->whereContractId($contract->id)->first();

            // NO SERVICE
            if(empty($contractService))
                return redirect()->back()->withStatusError("Service not found");

            $contractService->update($data);

            //dd($contractService, $data,$contract,$contract->customer->customer_sys_id , $customerSys->id);

            return redirect()->back()->withServiceSuccess(__("Service successfully changed to contract"));
        }
        catch (\Throwable $th)
        {

            if(env('APP_DEBUG') && auth()->user()->id < 1000)
            {
                report($th);
                
                dd($th,__('code-'.$th->getCode()));
            }

            return redirect()->back()->withInput($request->all())->withServiceError(__('th'.$th->getCode()));
        }
    }

    public function destroy(Request $request, $id)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CONTRACT
            $contract = ContractCustomer::whereContractNum($data['contract_num'])->first();

            // NOT FOUND
            if(empty($contract))
                return redirect()->back()->withStatusWarning('Contract Not Found');

            // NO CUSTOMER SYS
            if($contract->customer->customer_sys_id != $customerSys->id)
                return redirect()->back()->withStatusError("No authorization to access this contract");

            $contractService = ContractCusService::whereId($id)->whereContractId($contract->id)->first();

            // NO SERVICE
            if(empty($contractService))
                return redirect()->back()->withStatusError("Service not found");

            $contractService->delete();

            //dd($contractService, $data,$contract,$contract->customer->customer_sys_id , $customerSys->id);

            return redirect()->back()->withServiceSuccess(__("Service successfully deleted"));
        }
        catch (\Throwable $th)
        {

            if(env('APP_DEBUG') && auth()->user()->id < 1000)
            {
                report($th);
                
                dd($th,__('code-'.$th->getCode()));
            }

            return redirect()->back()->withInput($request->all())->withServiceError(__('th'.$th->getCode()));
        }
    }
}
