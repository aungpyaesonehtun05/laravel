<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class TestRequest extends FormRequest
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
            "name"=> "required",
            // "NRC"=> "required",
            // "phoneNo"=>"required",
            "email"=>"required",
            // "birthday"=>"required"
        ];
    }

    public function messages()
    {
        return [
        "name.required"=> "aaaa",
        // "NRC.required"=> "bbbb",
        // "phoneNo"=> "ccccc",
        "email"=> "dddd",
        // "birthday"=>"eeee"
        ];
    }

    // public function failesValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([$validator->errors()],422));
    // }
}
