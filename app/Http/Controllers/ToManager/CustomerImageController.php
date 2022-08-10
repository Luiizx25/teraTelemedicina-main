<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerImageController extends Controller
{
    public function remove(Request $request, $customerSlug)
    {
        $data = $request->all();

        $data['user_id'] = Auth()->user()->id;

        $customerSys = auth()->user()->customerSys->first();

        $customer = $customerSys->customer()->whereCusSlug($customerSlug)->first();
        $customer->cus_logo_use = 'none';
        $customer->cus_logo = null;
        $customer->save();

        //dd($data,$customerSlug,$customer);

        return redirect()->back()->withStatusSuccess('Customer Logo Removed!');
    }
}
