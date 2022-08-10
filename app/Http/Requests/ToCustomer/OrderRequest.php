<?php

namespace App\Http\Requests\ToCustomer;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            //'back' => ['required','string'],
            "pat_doc_type" =>  ['required','string'],
            "pat_doc_num" => ['required','string'],
            "pat_identity_num" => ['nullable','string'],
            "pat_identity_emitting" => ['nullable','string'],
            "pat_name" =>  ['required','string'],
            "pat_email" => ['nullable','email'],
            "pat_date_birth" => ['required','date'],
            "pat_genre" => ['required','string'],
            "pat_phone_mobile" => ['nullable','string'],
            "pat_phone" => ['nullable','string'],
            "pat_postalcode" => ['nullable','string'],
            "pat_street" => ['nullable','string'],
            "pat_street_num" => ['nullable','string'],
            "pat_street_complement" => ['nullable','string'],
            "pat_street_neighborhood" => ['nullable','string'],
            "pat_city" => ['nullable','string'],
            "pat_state" => ['nullable','string'],
            "pat_work_company" => ['nullable','string'],
            "pat_work_position" => ['nullable','string'],
            "pat_weight" => ['required','numeric'],
            "pat_height" => ['required','numeric'],
            "pat_comments" => ['nullable','string'],
            "order_description" => ['nullable','string'],
        ];
    }
}
