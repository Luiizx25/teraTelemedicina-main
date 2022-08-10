<?php 

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\ServiceVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ServiceVariationController extends Controller
{
    private $Variation;

    public function __construct(ServiceVariation $Variation)
    {
        $this->Variation = $Variation;
    }

    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $services = $customerSys->service()->orderBy('service_name')->get();

        return view('customerSys.service.variation.index', compact('services'));
    }

    public function create()
    {
        $service = auth()->user()->customerSys->first()->service;

        if(!$service)
            return redirect()->back()->withStatusError(__('c404'));

        return view('customerSys.service.variation.create',compact('service'));
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

            $data['slug'] = Str::slug($service->service_slug.' '.$data['variation_name'], '-');

            $this->Variation->create($data);

            DB::commit();

            return redirect()->route('toManager.serviceVariation.index')->withStatusSuccess('Successfully created');
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

    public function edit(Request $request, $variationSlug)
    {
        $Variation = $this->Variation->whereSlug($variationSlug)->first();

        if(!$Variation)
            return redirect()->back()->withStatusError(__('c404'));

        if($Variation->service->customer_sys_id != auth()->user()->customerSys->first()->id)
            return redirect()->back()->withStatusError(__('c401'));

        return view('customerSys.service.variation.edit', compact('Variation'));
    }

    public function update(Request $request, $variationSlug)
    {
        try
        {
            $data = $request->all();

            DB::beginTransaction();

            $Variation = $this->Variation->whereSlug($variationSlug)->first();

            if(!$Variation)
                return redirect()->back()->withStatusError(__('c404'));

            if($Variation->service->customer_sys_id != auth()->user()->customerSys->first()->id)
                return redirect()->back()->withStatusError(__('c401'));

            $data['slug'] = Str::slug($Variation->service->service_slug.' '.$data['variation_name'], '-');

            $Variation->update($data);

            DB::commit();

            return redirect()->back()->withStatusSuccess('Successfully changed');
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

    public function destroy($variationSlug)
    {
        try
        {
            DB::beginTransaction();

            $Variation = $this->Variation->whereSlug($variationSlug)->first();

            if(!$Variation)
                return redirect()->back()->withStatusError(__('c404'));

            if($Variation->service->customer_sys_id != auth()->user()->customerSys->first()->id)
                return redirect()->back()->withStatusError(__('c401'));

            $Variation->delete();

            DB::commit();

            return redirect()->route('toManager.serviceVariation.index')->withStatusSuccess('Successfully deleted');
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

            return redirect()->back()->withInput($request->all())->withNoshStatusError(__($msg));
        }
    }
}
