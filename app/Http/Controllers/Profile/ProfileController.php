<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadTrait;


use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

class ProfileController extends Controller
{
    use UploadTrait;

    public function index()
    {
        return view('app.profile.index');
    }

    public function update(ProfileRequest $request)
    {
        $data = $request->all();

        // PHOTO
        if($request->hasFile('photo'))
            $data['photo'] = $this->imageUpload($request->file('photo'),'userPhoto');

        auth()->user()->update($data);

        return redirect()->back()->withStatus(__('Profile successfully updated'));
    }

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

        return redirect()->back()->withStatusPassword(__('Password successfully updated'));
    }
}
