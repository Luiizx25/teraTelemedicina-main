<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSys\UserPwdCustomerSysRequest;
use App\Http\Requests\CustomerSys\UserCustomerSysRequest;
use App\User;
use Illuminate\Http\Request;

class UserCustomerSysController extends Controller
{
    public function index()
    {
        dd('index');
    }

    public function create()
    {
        //
    }

    public function store(UserCustomerSysRequest $request)
    {
        try
        {
            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $users = new User();

            $user = $users->create($data);

            $customerSys->user()->attach($user->id);

            return redirect()->back()->withStatusSuccess('User successfully created')->with('tabActive', 'system_users');
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

            return redirect()->back()->withStatusError(__($msg))->with('tabActive', 'system_users');
        }
    }

    public function show($email)
    {
        dd('show');
    }

    public function edit($email)
    {
        $customerSys = auth()->user()->customerSys->first();

        $user = $customerSys->user()->whereEmail($email)->first();

        if(empty($user))
            return redirect()->back()->withStatusWarning('User Not Found');

        return view('customerSys.user.edit', compact('user'));
    }

    public function update(UserCustomerSysRequest $request, $id)
    {
        try
        {
            $data = $request->all();

            // SET ADMIN
            $adminList = ['admin_system','admin_customer','admin_provider','admin_patient','admin_financial','admin_billing'];

            foreach ($adminList as $admin)
                if(empty($data[$admin]))
                    $data[$admin] = 0;

            $customerSys = auth()->user()->customerSys->first();

            $user = $customerSys->user()->find($id);

            if(empty($user))
                return redirect()->back()->withStatusWarning('User Not Found');

            $user->update($data);

            return redirect()->route('toManager.SystemAdmin.index')->withStatusSuccess('User successfully changed')->with('tabActive', 'system_users');
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

            return redirect()->back()->withStatusError(__($msg))->with('tabActive', 'system_users');
        }
    }

    public function updatePwd($id, UserPwdCustomerSysRequest $request)
    {
        try
        {
            $data = $request->all();

            $customerSys = auth()->user()->customerSys->first();

            $user = $customerSys->user()->find($id);

            if(empty($user))
                return redirect()->back()->withStatusWarning('User Not Found');

            $user->update($data);

            return redirect()->route('toManager.SystemAdmin.index')->withStatusSuccess('User Password successfully changed')->with('tabActive', 'system_users');
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



    public function destroy($id)
    {
        //
    }
}
