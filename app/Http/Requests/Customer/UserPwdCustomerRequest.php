<?php

namespace App\Http\Requests\Customer;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserPwdCustomerRequest extends FormRequest
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
            'password' => [
                'required',
                'string',
                'min:8',              // Precisa ter 8 caracteres
                'regex:/[a-z]/',      // precisa ter letra minúsculo
                'regex:/[A-Z]/',      // precisa ter letra minusculo
                'regex:/[0-9]/',      // precisa ter dígito
                'regex:/[.;|@$!%*#?&]/', // precisa ter caractere especial
                'confirmed'
            ],
        ];
        
    }
}
