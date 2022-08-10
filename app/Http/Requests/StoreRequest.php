<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true; // PARA ELE PASSAR AUTORIZADO JA QUE VAMOS TESTAR DEPOIS
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => ['required','min:5','max:200'],
            'ref_description'   => ['required','min:5','max:200'],
            'phone'         => 'required',
            'mobile_phone'  => 'required',
            'logo'          => 'image',
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'Campo obrigatório.',
            'min'       => 'Campo deve possuir mínimo de :min caracteres.',
            'max'       => 'Campo deve possuir mínimo de :max caracteres.',
            'image'    => 'Arquivo não é ima imagem válida!',
        ];
    }
}
