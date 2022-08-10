<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\PasswordRequest;

class MandatoryReset extends Controller
{
    public function password(PasswordRequest $request)
    {
        
        // TO CUSTOMER
        if(auth()->user()->customer->count())
        {
            $dias="90";
        }
        
        // TO PROVIDER
        if(auth()->user()->provider)
        {
            $dias="90";
        }
        
        // TO MANAGER
        if(auth()->user()->customerSys->count())
        {
            $dias="180";
        }
        
        // TO ADMIN
        if(auth()->user()->id < 1000)
        {
            $dias="180";
        }
        auth()->user()->update(['password' => Hash::make($request->get('password')), 'validity_password' => date("Y-m-d", strtotime("+$dias Days"))]);

        return redirect()->route('home');;
    }
}
