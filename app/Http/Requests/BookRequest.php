<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'tour_name' => 'required|alpha_num',
            'tour_email' => 'email:rfc,dns',
            'tour_ph' => 'bail|required|regex:/^([0-9]*)$/|digits:11',
            'from' => 'required|date',
            'to' => 'required|date|after:from_date',
            'people' => 'required|integer|between:1,20',
            'contant' => 'required|in:1,3',
            'image' => 'required|image|mimes:pdf,xlsx,jpeg,png,jpg|max:10000' 
        ];
    }

    public function messages()
    {
        return [
        "tour_name.required"=> "aaaa",
        "tour_email"=> "dddd",
        ];
    }
}
