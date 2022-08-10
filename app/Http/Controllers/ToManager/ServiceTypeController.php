<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\ListBoolean;
use App\Model\RefServiceCategory;
use App\Model\RefServiceType;
use App\Model\Service;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    private $serviceType;

    public function __construct(RefServiceType $serviceType)
    {
        $this->serviceType = $serviceType;
    }

    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $serviceTypes = $this->serviceType->whereNull('customer_sys_id')->orWhere('customer_sys_id', $customerSys->id)->orderBy('ref_slug')->get();

        $ListBoolean = ListBoolean::all('id','ref_description');

        return view('customerSys.service.type.index', compact('serviceTypes','ListBoolean'));
    }

    public function store(Request $request)
    {
        try
        {
            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $serviceType = $customerSys->serviceType()->create($data);

            return redirect()->back()->withStatusSuccess(__("Service Type successfully created"));
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
            $serviceType = $customerSys->serviceType()->find($id);

            // NOT FOUND
            if(empty($serviceType))
                return redirect()->back()->withStatusWarning('Service Type Not Found');

            $serviceType->update($data);

            return redirect()->back()->withStatusSuccess(__("Service Type successfully changed"));
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
            $serviceType = $customerSys->serviceType()->find($id);

            // NOT FOUND
            if(empty($serviceType))
                return redirect()->back()->withStatusWarning('Service Type Not Found');

            $serviceType->delete();

            return redirect()->back()->withStatusSuccess(__("Service Type successfully deleted"));
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
