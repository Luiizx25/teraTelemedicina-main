<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\ListBoolean;
use App\Model\RefServiceCategory;
use App\Model\RefServiceType;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    private $serviceCategory;

    public function __construct(RefServiceCategory $serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;
    }

    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $serviceCategories = $this->serviceCategory->whereNull('customer_sys_id')->orWhere('customer_sys_id', $customerSys->id)->orderBy('ref_description')->orderBy('ref_slug')->get();

        $RefServiceType = RefServiceType::whereNull('customer_sys_id')->orWhere('customer_sys_id', $customerSys->id)->orderBy('ref_slug')->get();

        return view('customerSys.service.category.index', compact('serviceCategories','RefServiceType'));
    }

    public function store(Request $request)
    {
        try
        {
            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $serviceCategory = $customerSys->serviceCategory()->create($data);

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
            $serviceCategory = $customerSys->serviceCategory()->find($id);

            // NOT FOUND
            if(empty($serviceCategory))
                return redirect()->back()->withStatusWarning('Service Type Not Found');

            $serviceCategory->update($data);

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
            $serviceCategory = $customerSys->serviceCategory()->find($id);

            // NOT FOUND
            if(empty($serviceCategory))
                return redirect()->back()->withStatusWarning('Service Type Not Found');

            $serviceCategory->delete();

            return redirect()->route('toManager.serviceCategory.index')->withStatusSuccess(__("Service Type successfully deleted"));
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
