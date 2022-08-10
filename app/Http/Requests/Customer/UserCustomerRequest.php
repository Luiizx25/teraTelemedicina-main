<?php

namespace App\Http\Requests\Customer;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserCustomerRequest extends FormRequest
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
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->id],
                    'phone_mobile' => ['required', 'string'],
                    'phone' => ['required', 'string']
                ];
                break;
            default:
                $rules = [
                    'active' => ['required', 'boolean'],
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => [
                        'required',
                        'string',
                        'min:8',              // Precisa ter 8 caracteres
                        'regex:/[a-z]/',      // precisa ter letra minúsculo
                        'regex:/[A-Z]/',      // precisa ter letra minusculo
                        'regex:/[0-9]/',      // precisa ter dígito
                        'regex:/[@$!%*#?&]/', // precisa ter caractere especial
                        'confirmed'
                    ],
                    'phone_mobile' => ['required', 'string'],
                    'phone' => ['required', 'string']
                ];
                break;
        }

        return $rules;

    }
}
