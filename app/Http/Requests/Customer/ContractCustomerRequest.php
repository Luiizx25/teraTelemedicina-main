<?php

namespace App\Http\Requests\Customer;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ContractCustomerRequest extends FormRequest
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
            'contract_previous_id' => ['nullable'],
            'active' => ['required'],
            'type_id' => ['required'],
            'contract_num' => ['nullable'],
            'contract_date' => ['required'],
            'contract_date_start' => ['required'],
            'contract_date_end' => ['required'],
            'contract_volume_free' => ['required'],
            'contract_comments' => ['nullable','max:255'],
            'invoice_day' => ['required'],
            'invoice_pay_option_id' => ['required']
        ];
    }
}
