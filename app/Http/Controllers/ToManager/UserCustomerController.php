<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UserCustomerRequest;
use App\Http\Requests\Customer\UserPwdCustomerRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\EnvioEmailNewUserMsg;


class UserCustomerController extends Controller
{
    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $customers = $customerSys->customer()->get();

        if(empty($customers))
            return redirect()->route('toManager.customer.index');

        return view('customer.user.index', compact('customers'));
    }

    public function create(Request $request)
    {
        // GET CUSTOMERSYS
        $customerSys = auth()->user()->customerSys->first();

        // GET CUSTOMER
        $customer = $customerSys->customer()->whereCusSlug($request->input('customerSlug')??null)->first();

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        return view('customer.user.create', compact('customer'));
    }

    public function store(UserCustomerRequest $request)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CUSTOMER
            $customer = $customerSys->customer()->whereCusSlug($data['cus_slug']??null)->first();

            if(empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            // DB::beginTransaction();

            $users = new User();

            $user = $users->create($data);

            $customer->user()->attach([$user->id => ['financial' => $data['financial'] ?? false, 'manager' => $data['manager'] ?? false, 'tecnical' => $data['tecnical'] ?? false]]);

            // dd(
            //     $data,
            //     $customer->user->toArray(),
            //     $user->toArray(),
            // );

            // DB::rollBack();
            try {
                \Notification::send($user, new EnvioEmailNewUserMsg($user));
            } catch (\Throwable $th) {
                //throw $th;
            }

            return redirect()->route('toManager.customer.show',['customer'=>$customer->cus_slug])->withStatusSuccess('User successfully created');
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

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $email)
    {
        // GET CUSTOMERSYS
        $customerSys = auth()->user()->customerSys->first();

        // GET USER
        $user = User::whereEmail($email)->first();

        if(empty($user))
            return redirect()->back()->withStatusWarning('User Not Found');

        $customer = $user->customer()->whereCusSlug($request->input('customerSlug'))->first();

        if(empty($customer))
            return redirect()->back()->withStatusWarning('Customer Not Found');

        return view('customer.user.edit', compact('user','customer'));
    }

    public function update($id, UserCustomerRequest $request)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CUSTOMER
            $customer = $customerSys->customer()->whereCusSlug($data['cus_slug']??null)->first();

            if(empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $user = $customer->user()->find($id);

            if(empty($user))
                return redirect()->back()->withStatusWarning('User Not Found');

            $user->update($data);

            $user->customer()->updateExistingPivot($customer->id, ['financial' => $data['financial'] ?? false, 'manager' => $data['manager'] ?? false, 'tecnical' => $data['tecnical'] ?? false]);

            return redirect()->route('toManager.customer.show',['customer'=>$customer->cus_slug])->withStatusSuccess('User successfully updated');
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

    public function updatePwd($id, UserPwdCustomerRequest $request)
    {
        try
        {
            $data = $request->all();

            // GET CUSTOMERSYS
            $customerSys = auth()->user()->customerSys->first();

            // GET CUSTOMER
            $customer = $customerSys->customer()->whereCusSlug($data['cus_slug']??null)->first();

            if(empty($customer))
                return redirect()->back()->withStatusWarning('Customer Not Found');

            $user = $customer->user()->find($id);

            if(empty($user))
                return redirect()->back()->withStatusWarning('User Not Found');

            $user->update($data);

            return redirect()->route('toManager.customer.show',['customer'=>$customer->cus_slug])->withStatusSuccess('User successfully updated');
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
