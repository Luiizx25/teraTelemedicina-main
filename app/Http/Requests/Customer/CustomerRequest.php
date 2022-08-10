<?php

namespace App\Http\Requests\Customer;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => ['required'],
            'cus_doc_type' => ['required'],
            'cus_doc_num' => ['required'],
            'cus_name' => ['required', 'min:5'],
            'cus_name_company' => ['required_if:cus_doc_type,CNPJ', 'min:5'],
            'cus_phone' => ['required'],
            'cus_email' => ['required','email'],
            'cus_street' => ['required'],
            'cus_street_num' => ['required'],
            'cus_street_complement' => ['nullable'],
            'cus_neighborhood' => ['required'],
            'cus_city' => ['required'],
            'cus_state' => ['required'],
            'cus_postalcode' => ['required'],
            'cus_manager_name' => ['required'],
            'cus_manager_phone' => ['required'],
            'cus_manager_email' => ['required','email'],
            'cus_financial_name' => ['required'],
            'cus_financial_phone' => ['required'],
            'cus_financial_email' => ['required','email'],
            'cus_logo_use' => ['nullable'],
            'cus_logo' => ['nullable','required_if:cus_logo_use,customer','mimes:jpeg,png,jpg,gif|max:2048'],
            'bank_id' => ['nullable'],
            'bank_agency_num' => ['nullable','required_with:bank_id','numeric'],
            'bank_agency_dv' => ['nullable','required_with:bank_id','numeric'],
            'bank_account_type_id' => ['nullable','required_with:bank_id','numeric'],
            'bank_account_num' => ['nullable','required_with:bank_id','numeric'],
            'bank_account_dv' => ['nullable','required_with:bank_id','numeric'],
        ];
    }
}
