<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\RefProviderType;
use Illuminate\Http\Request;

class ProviderTypeController extends Controller
{
    private $providerType;

    public function __construct(RefProviderType $providerType)
    {
        $this->providerType = $providerType;
    }

    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $providerTypes = $this->providerType->whereNull('customer_sys_id')->orWhere('customer_sys_id', $customerSys->id)->orderBy('ref_slug')->get();

        return view('customerSys.provider.type.index', compact('providerTypes'));
    }

    public function store(Request $request)
    {
        try
        {
            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $providerType = $customerSys->providerType()->create($data);

            return redirect()->back()->withStatusSuccess(__("provider Type successfully created"));
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

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET
            $providerType = $customerSys->providerType()->find($id);

            // NOT FOUND
            if(empty($providerType))
                return redirect()->back()->withStatusWarning('provider Type Not Found');

            $providerType->update($data);

            return redirect()->back()->withStatusSuccess(__("provider Type successfully changed"));
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

            return redirect()->back()->withStatusUpdateError(__($msg));
        }
    }

    public function destroy($id)
    {
        try
        {
            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET
            $providerType = $customerSys->providerType()->find($id);

            // NOT FOUND
            if(empty($providerType))
                return redirect()->back()->withStatusWarning('provider Type Not Found');

            $providerType->delete();

            return redirect()->back()->withStatusSuccess(__("provider Type successfully deleted"));
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
}
