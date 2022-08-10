<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\ServicePreResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ServicePreResponsesController extends Controller
{
    private $PreResponse;

    public function __construct(ServicePreResponse $PreResponse)
    {
        $this->PreResponse = $PreResponse;
    }

    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $services = $customerSys->service()->orderBy('service_name')->get();

        //dd($services[0]->PreResponse->toArray());

        //dd($RefServiceCategory,$services);

        return view('customerSys.service.preResponse.index', compact('services'));
    }

    public function create()
    {
        $service = auth()->user()->customerSys->first()->service;

        if(!$service)
            return redirect()->back()->withStatusError(__('c404'));

        return view('customerSys.service.preResponse.create',compact('service'));
    }

    public function store(Request $request)
    {
        try
        {
            $data = $request->all();

            $service = auth()->user()->customerSys->first()->service->find($data['service_id']);

            if(!$service)
                return redirect()->back()->withStatusError(__('Service').' '.__('c404'));

            DB::beginTransaction();

            $data['slug'] = Str::slug($service->service_slug.' '.$data['title'], '-');

            $this->PreResponse->create($data);

            DB::commit();

            return redirect()->route('toManager.servicePreResponse.index')->withStatusSuccess('Successfully created');
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

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function edit(Request $request, $preResponseSlug)
    {
        $PreResponse = $this->PreResponse->whereSlug($preResponseSlug)->first();

        if(!$PreResponse)
            return redirect()->back()->withStatusError(__('c404'));

        if($PreResponse->service->customer_sys_id != auth()->user()->customerSys->first()->id)
            return redirect()->back()->withStatusError(__('c401'));

        return view('customerSys.service.preResponse.edit', compact('PreResponse'));
    }

    public function update(Request $request, $preResponseSlug)
    {
        try
        {
            $data = $request->all();

            DB::beginTransaction();

            $PreResponse = $this->PreResponse->whereSlug($preResponseSlug)->first();

            if(!$PreResponse)
                return redirect()->back()->withStatusError(__('c404'));

            if($PreResponse->service->customer_sys_id != auth()->user()->customerSys->first()->id)
                return redirect()->back()->withStatusError(__('c401'));

            $data['slug'] = Str::slug($PreResponse->service->service_slug.' '.$data['title'], '-');

            $PreResponse->update($data);

            DB::commit();

            return redirect()->route('toManager.servicePreResponse.index')->withStatusSuccess('Successfully changed');
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

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }

    public function destroy($preResponseSlug)
    {
        try
        {
            DB::beginTransaction();

            $PreResponse = $this->PreResponse->whereSlug($preResponseSlug)->first();

            if(!$PreResponse)
                return redirect()->back()->withStatusError(__('c404'));

            if($PreResponse->service->customer_sys_id != auth()->user()->customerSys->first()->id)
                return redirect()->back()->withStatusError(__('c401'));

            $PreResponse->delete();

            DB::commit();

            return redirect()->route('toManager.servicePreResponse.index')->withStatusSuccess('Successfully deleted');
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

            return redirect()->back()->withInput($request->all())->withStatusError(__($msg));
        }
    }
}
