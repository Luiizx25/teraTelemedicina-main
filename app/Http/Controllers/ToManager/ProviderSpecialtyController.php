<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Model\RefProviderSpecialty;
use Illuminate\Http\Request;

class ProviderSpecialtyController extends Controller
{
    private $providerSpecialty;

    public function __construct(RefProviderSpecialty $providerSpecialty)
    {
        $this->providerSpecialty = $providerSpecialty;
    }

    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $providerSpecialties = $this->providerSpecialty->whereNull('customer_sys_id')->orWhere('customer_sys_id', $customerSys->id)->orderBy('ref_slug')->get();

        return view('customerSys.provider.specialty.index', compact('providerSpecialties'));
    }

    public function store(Request $request)
    {
        try
        {
            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $providerSpecialty = $customerSys->providerSpecialty()->create($data);

            return redirect()->back()->withStatusSuccess(__("Specialty successfully created"));
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
            $providerSpecialty = $customerSys->providerSpecialty()->find($id);

            // NOT FOUND
            if(empty($providerSpecialty))
                return redirect()->back()->withStatusWarning('Specialty Not Found');

            $providerSpecialty->update($data);

            return redirect()->back()->withStatusSuccess(__("Specialty successfully changed"));
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
            $providerSpecialty = $customerSys->providerSpecialty()->find($id);

            // NOT FOUND
            if(empty($providerSpecialty))
                return redirect()->back()->withStatusWarning('Specialty Not Found');

            $providerSpecialty->delete();

            return redirect()->back()->withStatusSuccess(__("Specialty successfully deleted"));
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
