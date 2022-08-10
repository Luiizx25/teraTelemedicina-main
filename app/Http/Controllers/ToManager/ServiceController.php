<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\ListBoolean;
use App\Model\RefServiceCategory;
use App\Model\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $services = $customerSys->service()->orderBy('service_name')->get();

        $RefServiceCategory = RefServiceCategory::all('id','ref_description')->keyBy('id');

        $ListBoolean = ListBoolean::all('id','ref_description');

        //dd($RefServiceCategory,$services);

        return view('customerSys.service.index', compact('services','RefServiceCategory','ListBoolean'));
    }

    public function store(Request $request)
    {
        try
        {
            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $service = $customerSys->service()->create($data);

            //dd($data,$service);

            return redirect()->route('toManager.service.index')->withStatusSuccess(__("Service successfully created"));
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
            $service = $customerSys->service()->whereServiceSlug($data['service_slug'])->first();

            // NOT FOUND
            if(empty($service))
                return redirect()->back()->withStatusWarning('Service Not Found');

            $service->update($data);

            //dd($data,$service);

            return redirect()->back()->withStatusSuccess(__("Service successfully changed"));
        }
        catch (\Throwable $th)
        {
            dd($th,__('code-'.$th->getCode()));

            if(in_array($th->getCode(),[0]))
                $msg = $th->getMessage();
            else
                $msg = 'th'.$th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function destroy($id)
    {
        try
        {
            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET
            $service = $customerSys->service()->find($id);

            // NOT FOUND
            if(empty($service))
                return redirect()->back()->withStatusWarning('Service Not Found');

            $service->delete();

            //dd($data,$service);

            return redirect()->back()->withStatusSuccess(__("Service successfully deleted"));
        }
        catch (\Throwable $th)
        {
            dd($th,__('code-'.$th->getCode()));

            if(in_array($th->getCode(),[0]))
                $msg = $th->getMessage();
            else
                $msg = 'th'.$th->getCode();

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }
}
