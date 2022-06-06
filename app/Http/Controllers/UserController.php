<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TestRequest;

class UserController extends Controller
{
        /**
 * To create user data
 *
 * @author  aungpyaesonehtun
 * @create  30/05/2022
 * @param Request $request
 * @return Response object
 */

    public function user(TestRequest $request){
        $rules = [
            //   'name' => 'required|alpha_num',
            //   'fathername' => 'null',
            //    'NRC' => ['required','regex:/(^([0-9]{1,2})\/([A-Z][a-z]|[A-Z][a-z][a-z])([A-Z][a-z]|[A-Z][a-z][a-z])([A-Z][a-z]|[A-Z][a-z][a-z])\([N,P,E]\)[0-9]{6}$)/u'],
            // //    'phoneNo' => 'bail|required|regex:/^([0-9]*)$/|digits:11',
            //    'email' => 'email:rfc,dns',
            //    'address' => 'null',
            //    'birthday' => 'required|date_format:Y-M-D',
            //    'gender' => 'required|numeric|between:1,2',
            //    'image' => 'required|image|mimes:jpeg,png,jpg|max:10000'
        ];

        //  $customMessages = [
        //     // 'name.required' => 'The :attribute field is required.',
        //     // 'name.alpha_num' => 'The attribute is not alpha number.',
        //     // 'NRC.required' => 'The :attribute field is required.',
        //     // 'NRC.regax' => 'Wrong NRC Format',
        //     //  'phoneNo.required' => 'phone number required.',
        // //     'email' => ''
        //  ];

        // $validator = Validator::make($request->all(), $rules,$customMessages);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->all(),422);
        // }

        return response()->json(['status'=>'OK','data'=>$request->all()],200);
    }



    public function save(TestRequest $request){
        return redirect()->route('success')->with('message','Successfully Insert');
    }

    // public function success()
    // {
    //     return view('success');
    // }
}
