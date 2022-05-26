<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
 * To get all product data
 *
 * @author  aungpyaesonehtun
 * @create  26/05/2022
 * @param Request $request
 * @return Response object
 */

public function index()
{
    # get all data from 'categories' table
    $categories = Category::whereNull('deleted_at')->get();
    Log::info($categories);

    # check categories empty or not
    if (!empty($categories)) {
        return response()->json(['status' => 'OK', 'data' =>$categories],200);
    } else {
        return response()->json(['status' => 'NG', 'message' => 'Data is not found!'],200);
    }
}


       /**
 * To store categories data
 *
 * @author  aungpyaesonehtun
 * @create  26/05/2022
 * @param Request $request
 * @return Response object
 */

public function store(Request $request)
{
    $insert =[
        'category_name' => $request->name,
        'created_emp' => $request->login_id,
        'updated_emp' => $request->login_id,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    $checkname = Category::where('category_name',$request->name)->get()->toArray();

    if(empty($checkname)){
        DB::beginTransaction();
    try {
        #save products table
        Category::insert($insert);

        DB::commit();
        return response()->json(['status' => 'OK', 'message' => 'Store successfully!'],200);

        DB::commit();
    }catch (Exception $e) {
        DB::rollBack();
        Log::debug($e->getMessage());
        return response()->json(['status' => 'NG', 'message' => 'Fail to save!'],200);
    }
    } else {
        return response()->json(['status' => 'NG', 'message' => 'Category_name already exists!!'],200);
    }

}


          /**
 * To show categories data
 *
 * @author  aungpyaesonehtun
 * @create  26/05/2022
 * @param Request $request
 * @return Response object
 */

    public function show($id)
    {
        $categories = Category::where('id',$id)->get();
    
        # check categories empty or not
        if ($categories->isNotEmpty()) {
            return response()->json(['status' => 'OK', 'data' =>$categories],200);
        } else {
            return response()->json(['status' => 'NG', 'message' => 'Data is not found!'],200);
        }
    }

    /**
    * To update categories data
    *
    * @author  aungpyaesonehtun
    * @create  26/05/2022
    * @param Request $request
    * @return Response object
    */
   
    public function update(Request $request, $id)
   {
       $update = [
           'category_name' => $request->name,
           'updated_emp' => $request->login_id,
           'updated_at' => now()
       ]; //dd($id);

       $check_id = Category::where('id',$id)->get();

       if($check_id->isNotEmpty()){
        DB::beginTransaction();
        try{
            Category::where('id',$id)->update($update);
            DB::commit();
            return response()->json(['status' => 'OK', 'message' => 'Update successful!'],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e->getMessage());
            return response()->json(['status' => 'NG', 'message' => 'Fail to update!'],200);
        }
       } else{
        return response()->json(['status' => 'NG', 'message' => 'Category does not exist!!'],200);   
       }
    }

    /**
 * To delete categories data
 *
 * @author  aungpyaesonehtun
 * @create  26/05/2022
 * @param Request $request
 * @return Response object
 */

public function destroy($id)
{
    $delete_category = Category::where('id',$id)->get();
    if($delete_category->isNotEmpty()){
        DB::beginTransaction();
    try{
        Category::where('id',$id)->delete();
        DB::commit();
        return response()->json(['status' => 'OK', 'message' => 'Delete successful!'],200);
    } catch (Exception $e) {
        DB::rollback();
        Log::debug($e->getMessage());
        return response()->json(['status' => 'NG', 'message' => 'Fail to delete!'],200);
    }
    } else{
        return response()->json(['status' => 'NG', 'message' => 'Already Delete!!!'],200);
    }
}
}
