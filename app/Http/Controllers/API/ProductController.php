<?php

namespace App\Http\Controllers\API;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

/**
 * After overtime request list
 *
 * @author  aungpyaesonehtun
 * @create  25/05/2022
 */

class ProductController extends Controller
{

    /**
 * To create product data
 *
 * @author  aungpyaesonehtun
 * @create  25/05/2022
 * @param Request $request
 * @return Response object
 */

    public function create(Request $request)
    {
        $insert =[
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'created_emp' => $request->login_id,
            'updated_emp' => $request->login_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $namae = Product::where('name',$request->name)->get()->toArray();

        if(empty($namae)){

            DB::beginTransaction();
            try {
                #save products table
                Product::insert($insert);
    
                DB::commit();
                return response()->json(['status' => 'OK', 'message' => 'Create successfully!'],200);
    
                DB::commit();
            }catch (Exception $e) {
                DB::rollBack();
                Log::debug($e->getMessage());
                return response()->json(['status' => 'NG', 'message' => 'Fail to save!'],200);
            }
        } else{
            return response()->json(['status' => 'NG', 'message' => 'Product name already exists!!'],200);
        }
        }


/**
 * To get all product data
 *
 * @author  aungpyaesonehtun
 * @create  25/05/2022
 * @param Request $request
 * @return Response object
 */

    public function index()
    {
        # get all data from 'products' table
        $products = Product::whereNull('deleted_at')->get();
        Log::info($products);

        # check products is exists or not
        if (!empty($products)) {
            return response()->json(['status' => 'OK', 'data' =>$products],200);
        } else {
            return response()->json(['status' => 'NG', 'message' => 'Data is not found!'],200);
        }
    }

    /**
 * To update product data
 *
 * @author  aungpyaesonehtun
 * @create  26/05/2022
 * @param Request $request
 * @return Response object
 */

    public function update(Request $request, $id)
{
    $update = [
        'name' => $request->name,
        'code' => $request->code,
        'description' => $request->description,
        'updated_emp' => $request->login_id,
        'updated_at' => now()
    ];

    $check_code = Product::where('id',$id)->get();

    if($check_code->isNotEmpty()){
        DB::beginTransaction();
        try{
            Product::where('id',$id)->update($update);
            DB::commit();
            return response()->json(['status' => 'OK', 'message' => 'Update successful!'],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e->getMessage());
            return response()->json(['status' => 'NG', 'message' => 'Fail to update!'],200);
        }
    } else {
        return response()->json(['status' => 'NG', 'message' => 'Your Product id does not exist!!!'],200);
    }
        
    }

/**
 * To delete product data
 *
 * @author  aungpyaesonehtun
 * @create  26/05/2022
 * @param Request $request
 * @return Response object
 */

public function delete($id)
{
    $delete_product = Product::where('id',$id)->get();
    if($delete_product->isNotEmpty()){

        DB::beginTransaction();
        try{
            Product::where('id',$id)->delete();
            DB::commit();
            return response()->json(['status' => 'OK', 'message' => 'Delete successful!'],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e->getMessage());
            return response()->json(['status' => 'NG', 'message' => 'Fail to delete!'],200);
        }
    } else {
        return response()->json(['status' => 'NG', 'message' => 'Already delected this product!!'],200);
    }
    }

}
