<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProviderImageController extends Controller
{
    public function remove(Request $request, $customerSlug)
    {
        $data = $request->all();

        $data['user_id'] = Auth()->user()->id;

        $customerSys = auth()->user()->customerSys->first();

        $customer = $customerSys->provider()->wherePvdSlug($customerSlug)->first();

        if($data['target'] == 'pvd_logo')
        {
            $customer->pvd_logo_use = 'false';
            $customer->pvd_logo = null;
        }

        if($data['target'] == 'pvd_signature')
        {
            $customer->pvd_signature_use = 'false';
            $customer->pvd_signature = null;
        }

        $customer->save();

        //dd($data,$customerSlug,$customer);

        return redirect()->back()->withStatusSuccess('Provider Image Removed');
    }
}
