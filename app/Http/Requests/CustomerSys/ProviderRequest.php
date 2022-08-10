<?php

namespace App\Http\Requests\CustomerSys;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
        // var_dump($this->id,$this->email,$this->method());
        // die;

        switch ($this->method()) {
            case 'PUT':
                $rules = [
                        //'back' => ['required'],
                        'name' => ['required', 'string'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user_id],
                        'phone' => ['required'],
                        'phone_mobile' => ['required'],
                        'type_id' => ['required'],
                        'pvd_doc_type' => ['required'],
                        'pvd_doc_num' => ['required'],
                        'pvd_identity_type' => ['required'],
                        'pvd_identity_num' => ['required'],
                        'pvd_name_company' => ['required_if:pvd_doc_type,cnpj', 'min:5'],
                        'pvd_street' => ['required'],
                        'pvd_street_num' => ['required'],
                        'pvd_street_complement' => ['nullable'],
                        'pvd_neighborhood' => ['required'],
                        'pvd_city' => ['required'],
                        'pvd_state' => ['required'],
                        'pvd_postalcode' => ['required'],
                        'pvd_logo_use' => ['required'],
                        'pvd_logo' => ['nullable','required_if:pvd_logo_use,1'],
                        'pvd_signature_use' => ['required'],
                        'pvd_signature' => ['nullable','required_if:pvd_signature_use,1'],
                        'bank_id' => ['nullable'],
                        'bank_agency_num' => ['nullable','required_with:bank_id','numeric'],
                        'bank_agency_dv' => ['nullable','required_with:bank_id','numeric'],
                        'bank_account_type_id' => ['nullable','required_with:bank_id','numeric'],
                        'bank_account_num' => ['nullable','required_with:bank_id','numeric'],
                        'bank_account_dv' => ['nullable','required_with:bank_id','numeric'],
                    ];
                break;
            default:
                $rules = [
                    //'back' => ['required'],
                    'name' => ['required', 'string'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'phone' => ['required'],
                    'phone_mobile' => ['required'],
                    'type_id' => ['required'],
                    'pvd_doc_type' => ['required'],
                    'pvd_doc_num' => ['required'],
                    'pvd_identity_type' => ['required'],
                    'pvd_identity_num' => ['required'],
                    'pvd_name_company' => ['required_if:pvd_doc_type,cnpj', 'min:5'],
                    'pvd_street' => ['required'],
                    'pvd_street_num' => ['required'],
                    'pvd_street_complement' => ['nullable'],
                    'pvd_neighborhood' => ['required'],
                    'pvd_city' => ['required'],
                    'pvd_state' => ['required'],
                    'pvd_postalcode' => ['required'],
                    'pvd_logo_use' => ['required'],
                    'pvd_logo' => ['nullable','required_if:pvd_logo_use,1'],
                    'pvd_signature_use' => ['required'],
                    'pvd_signature' => ['nullable','required_if:pvd_signature_use,1'],
                    'bank_id' => ['nullable'],
                    'bank_agency_num' => ['nullable','required_with:bank_id','numeric'],
                    'bank_agency_dv' => ['nullable','required_with:bank_id','numeric'],
                    'bank_account_type_id' => ['nullable','required_with:bank_id','numeric'],
                    'bank_account_num' => ['nullable','required_with:bank_id','numeric'],
                    'bank_account_dv' => ['nullable','required_with:bank_id','numeric'],
                ];
                break;
        }

        return $rules;
    }
}
