<?php

namespace App\Http\Controllers\ToManager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Model\Customer;
use App\Model\ListBank;
use App\Model\ListBankAccountType;
use App\Model\RefBankAccountType;
use App\Model\RefCustomerType;
use App\Model\RefDocTypeCus;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use UploadTrait;

    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function index()
    {
        $customerSys = auth()->user()->customerSys->first();

        $customers = $customerSys->customer()->orderBy('cus_name')->get();

        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        $RefCustomerType = RefCustomerType::all('id', 'ref_description');

        $RefDocTypeCus = RefDocTypeCus::all('ref_slug', 'ref_description');

        $ListBank = ListBank::all('id', 'ref_description', 'ref_options');

        $ListBankAccountType = ListBankAccountType::all('id', 'ref_description');

        return view('customer.create', compact('RefCustomerType', 'RefDocTypeCus', 'ListBank', 'ListBankAccountType'));
    }

    public function store(CustomerRequest $request)
    {
        try {
            $data = $request->all();

            $data['user_id'] = Auth()->user()->id;

            // SAVE LOGO
            if ($request->hasFile('cus_logo'))
                $data['cus_logo'] = $this->imageUpload($request->file('cus_logo'), 'customerLogo');

            $customerSys = auth()->user()->customerSys->first();

            $customer = $customerSys->customer()->create($data);

            return redirect()->route('toManager.customer.show', ['customer' => $customer->cus_slug])->withStatusSuccess(__('Customer successfully created'));
        } catch (\Throwable $th) {

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }

            return redirect()->back()->withInput($request->all())->withStatusError(__('th' . $th->getCode()));
        }
    }

    public function show($slug)
    {
        $customerSys = auth()->user()->customerSys->first();

        $customer = $customerSys->customer()->whereCusSlug($slug)->first();

        if (empty($customer))
            return redirect()->route('toManager.customer.index');

        return view('customer.show', compact('customer'));
    }

    public function edit($cusSlug)
    {
        $customerSys = auth()->user()->customerSys->first();

        $customer = $customerSys->customer()->whereCusSlug($cusSlug)->get()->first();

        if (empty($customer))
            return redirect()->route('toManager.customer.index');

        //dd($cusSlug, $customerSys, $customer);

        $RefCustomerType = RefCustomerType::all('id', 'ref_description');

        $RefDocTypeCus = RefDocTypeCus::all('ref_slug', 'ref_description');

        $ListBank = ListBank::all('id', 'ref_description', 'ref_options');

        $ListBankAccountType = ListBankAccountType::all('id', 'ref_description');

        return view('customer.edit', compact('customer', 'RefCustomerType', 'RefDocTypeCus', 'ListBank', 'ListBankAccountType'));
    }

    public function update(CustomerRequest $request, $customerSlug)
    {
        try {
            $data = $request->all();

            $data['user_id'] = Auth()->user()->id;

            // SAVE LOGO
            if ($request->hasFile('cus_logo'))
                $data['cus_logo'] = $this->imageUpload($request->file('cus_logo'), 'customerLogo');

            $customerSys = auth()->user()->customerSys->first();

            $customer = $customerSys->customer()->whereCusSlug($customerSlug)->first();

            $customer->update($data);

            return redirect()->route('toManager.customer.show', ['customer' => $customer->cus_slug])->withStatusSuccess(__('Customer successfully changed'));
        } catch (\Throwable $th) {

            if (env('APP_DEBUG') && auth()->user()->id < 1000) {
                report($th);

                dd($th, __('code-' . $th->getCode()));
            }

            return redirect()->back()->withInput($request->all())->withStatusError(__('th' . $th->getCode()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
