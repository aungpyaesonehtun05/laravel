<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//  Route::get('contact', function(){
//      return response()-> json(['status' => 'OK', 'success' => true],200);
//  })->middleware('CheckAge');

//   Route::get('home', function(){
//       return response()-> json(['status' =>'OK', 'success' => true],200);
//   })->middleware('CheckGender');

//  Route::get('student', function(){
//      return response()-> json(['status' =>'OK', 'success' => 'You can attend University Now!!!'],200);
//  })->middleware('CheckStudents');

//  Route::get('marks', function(){
//      return response()-> json(['status'=> 'Congratulation!!!', 'success' => 'You pass'],200);
//  })->middleware('CheckExamMarks');


//   Route::middleware('CheckAge','CheckGender','CheckStudents','CheckExamMarks')-> group(function (){
//       Route:: get('contact', function (){
//           return response()->json(['status' => 'OK', 'success'=>true],200);
//      });

//       Route:: get('home', function(){
//           return response()->json(['status' => 'OK', 'success'=>true],200);
//       });

//       Route::get('student', function(){
//           return response()->json(['status' => 'OK', 'success'=>'You can attend University Now!!!'],200);
//       });

//       Route:: get('marks', function(){
//           return response()->json(['status'=> 'Congratulation!!!', 'success' => 'You pass'],200);
//       });


//   });
Route::group(['middleware'=>'setLocale'],function(){
    Route::get('lang',function(){
        return response()->json([
            'status' => 'OK',
            'message' => __('message.SE000')
        ],200);
    });
});
Route::prefix('products')->group(function (){
    Route::post('create','API\ProductController@create');
    Route::get('index' , 'API\ProductController@index');
    Route::put('update/{id}' , 'API\ProductController@update');
    Route::delete('delete/{id}' , 'API\ProductController@delete');

});

Route::apiResource('categories', 'API\CategoryController');

#test
Route::any('/test-request/{name}','TestRequestController@index');

#download file
Route::post('/download/{name}','TestRequestController@fileUpload');

// Validate
Route::post('register','TestRequestController@fileUpload')->name('register');

#upload file
//Route::post('/upload','TestRequestController@fileUpload');

Route::post('user','UserController@user');

//Route::post('book','BookingController@book');

Route::post('student','StudentController@student_reg');

Route::post('update/{student_id}','StudentController@update');

Route::post('teacher', 'TeacherController@store');
Route::delete('delete/{teacher_id}', 'TeacherController@delete');
Route::post('teacher/update/{teacher_id}', 'TeacherController@update');

Route::get('classes/index', 'ClassesController@index');
Route::get('classes/show/{id}', 'ClassesController@show');
Route::post('classes/store', 'ClassesController@store');
Route::post('classes/update/{id}', 'ClassesController@update');
Route::delete('classes/delete/{id}', 'ClassesController@delete');

//excel

Route::get('export', 'ExcelController@export')->name('export');
Route::get('importExportView', 'ExcelController@importExportView');
Route::post('import', 'ExcelController@import')->name('import');

Route::get('lang/{locale}',function ($locale){
    App::setLocale($locale);
    echo __('message.SE000');
    

});




