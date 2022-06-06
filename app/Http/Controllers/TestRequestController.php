<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestRequestController extends Controller
{
    // public function testRequest(){
    //     // return view('test', array('message' => "Hello Response Testing "));

    //     #file download
    //     $tmpFileName = 'test.pdf';
    //     $path = storage_path() . '/app/' . $tmpFileName;
    //     $headers = [
    //         'Access-Control-Allow-Origin' => '*',
    //         'Content-Description' => 'File Transfer',
    //         'Content-Disposition' => 'attachment;filename=' . $tmpFileName,
    //         'Access-Control-Expose-Headers' => 'Content-Disposition,X-Suggested-Filename'
    //     ];
    //     return response()->download($path, $tmpFileName,$headers)->deleteFileAfterSend(true);
    // }
    // function index(){

        // Log:: info(request()->method());

        // return request();

        // if(request()->has('name')){
        //     echo "has name";
        // }else{
        //     echo 'no name';
        // }

        //return "Hello Testing";

        // if(request()->missing('hh')){
        //     echo "not hh";
        // }

        //  if(request()->hasAny('name','age')){
        //      return request();
        //  } else{
        //      echo "NO name or age!!"; 
        //  }
    // }


    #Upload file on postman
    public function fileUpload(Request $request){

        // first validate
        // $validator = Validator::make($request->all(),[
        //     'name' => 'required',
        //     'age' => ['required','integer']
        // ]);

        // second validate
        // $validator = Validator::make($request->all(),[
        //     'name' => 'required',
        //     'age' => ['required|integer']
        // ]);

        // fourth validate
        // $validator = Validator::make($request->all(),[
        //     'name' => 'required',
        //     'age' => ['required','integer']

            $rules = [
                'name' => 'required',
                'age' => 'required|integer'
            ];
            $customMessages = [
                'name.required' => 'The :attribute field is required.',
                'age.required' => 'The :attribute field is aaaaa.',
                'age.integer' => 'The :attribute field is integer.'
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);
        // ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(),422);
            return response()->json($validator->errors()->first(),422);
            return response()->json($validator->errors()->get(),422);
        }
        
        $file =  $request->file('file');  
        //  Log::info($file);
        $fileName = $request->file->getClientOriginalName();  
        //  Log::info($fileName);
        $content = file_get_contents($request->file); 
        Storage::disk('local')->put($fileName,$content);
        //    Log::info($fileName);
        
        // $tmpFileName = 'InternSchedule(May2022_July2022)-bak.xlsx';
        $path = storage_path() . '/app/'.$fileName;  

        $img = Image::make($file);
        $img->resize(400, 300); 
        $img->save($path);
        // Log::info($path);

        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment;filename=' . $fileName,
            'Access-Control-Expose-Headers' => 'Content-Disposition,X-Suggested-Filename'
        ];
        return response()->download($path, $fileName,$headers);
    }
}
