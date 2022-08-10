<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'ref_description' => 'required',
            'body' => 'required',
            'price' => 'required',
            'photos.*' => 'required|image', // photos.* é usado quando o input photos, por exemplo, se tratar de um array
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo obrigatório',
            'min'      => 'Campo deve conter no minimo :min caracteres',
            'image'    => 'Arquivo não é ima imagem válida!',
        ];
    }
}
