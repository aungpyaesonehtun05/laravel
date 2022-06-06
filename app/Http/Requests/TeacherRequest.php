<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TeacherRequest extends FormRequest
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
            'name'=> 'required|string',
            'father_name'=> 'string',
            'nrc_number'=> ['required','regex:/(^([0-9]{1,2})\/([A-Z][a-z]|[A-Z][a-z][a-z])([A-Z][a-z]|[A-Z][a-z][a-z])([A-Z][a-z]|[A-Z][a-z][a-z])\([N,P,E]\)[0-9]{6}$)/u'],
            'phone_no'=> 'bail|required|regex:/^([0-9]*)$/|digits:11',
            'email'=> 'email:rfc,dns',
            'gender'=> 'required|integer|between:1,2',
            'date_of_birth'=> 'required|date_format:Y-m-d',
            'avatar'=> 'image|mimes:jpeg,png,jpg|max:10000',
            'address'=>'nullable',
            'career_path'=>'integer|required|between:1,2',
            'skill'=>'required',
            'skill.*'=>'integer|between:1,6',
            'created_emp'=>'integer',
         ];
    }
    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 'NG',
            'message' => $validator->errors(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
