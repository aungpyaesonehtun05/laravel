<?php

use Illuminate\Http\Request;
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

Route::prefix('products')->group(function (){
    Route::post('create','API\ProductController@create');
    Route::get('index' , 'API\ProductController@index');
    Route::put('update/{id}' , 'API\ProductController@update');
    Route::delete('delete/{id}' , 'API\ProductController@delete');

});

Route::apiResource('categories', 'API\CategoryController');

