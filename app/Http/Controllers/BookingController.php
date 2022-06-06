<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Requests\TestRequest;
use Illuminate\Routing\Controller;
use App\Http\Requests\BookRequest2;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class BookingController extends Controller
{
           /**
 * To create booking data
 *
 * @author  aungpyaesonehtun
 * @create  31/05/2022
 * @param Request $request
 * @return Response object
 */

    // public function book(Request $request)
    // {
        
    //     // $rules = [
    //     //        'name' => 'required|alpha_num',
    //     //        'email' => 'email:rfc,dns',
    //     //        'Phone' => 'bail|required|regex:/^([0-9]*)$/|digits:11',
    //     //        'from_date' => 'required|date',
    //     //        'to_date' => 'required|date|after:from_date',
    //     //        'people' => 'required|integer|between:1~20',
    //     //        'contact' => 'required|phone,email,other',
    //     //        'image' => 'required|image|mimes:pdf,xlsx,jpeg,png,jpg|max:10000'           
    //     // ];

    //      $validator = Validator::make($request->all(), $rules);
    //     dd('asdf');
    //     return response()->json(['status'=>'OK','data'=>$request->all()],200);
    // }

    public function save(BookRequest $request)
    { 

        return view('tour-show')->with('request',$request);
    }

}
