<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSys\UserPwdProviderRequest;
use Illuminate\Http\Request;

class UserProviderController extends Controller
{
    public function updatePwd($pvdSlug, UserPwdProviderRequest $request)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CUSTOMER
            $provider = $customerSys->provider()->wherePvdSlug($pvdSlug??null)->first();

            if(empty($provider))
                return redirect()->back()->withStatusWarning('Provider Not Found');

            $user = $provider->user()->find($provider->user_id);

            if(empty($user))
                return redirect()->back()->withStatusWarning('User Not Found');

            $user->update($data);

            return redirect()->back()->withStatusSuccess('Password successfully updated');
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
