<?php

namespace App\Http\Controllers;



use App\Models\Teacher;
use App\Models\Product;


use App\Models\Teacher_skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{ 
    function store(Request $request){  
        // return response()->json(['status' => 'OK' , 'message' => 'Teacher created successfully.'],200);
        try {
            DB::beginTransaction();
            #teacher create
            if($request->hasFile('avatar')){#image upload
                $file = $request->file('avatar');
                $filenameWithExt = $request->file('avatar')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                Storage::disk('local')->put( $fileNameToStore, file_get_contents($file));
            }
            $last_teacher_id = DB::table('teacher')->max('teacher_id');

            // dd( $last_teacher);
            $new_teacher_id = $last_teacher_id ? ++$last_teacher_id:'10001';
            $new_teacher_data = [
                'teacher_id' => $new_teacher_id,
                'name' => $request->name,
                'father_name' => $request->father_name,
                'nrc_number' => $request->nrc_number,
                'phone_no' => $request->phone_no,
                'email' => $request->email,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'avatar' => isset($fileNameToStore) ? $fileNameToStore : null ,
                'address' => $request->address,
                'carrer_path' => isset($request->career_path) ? $request->career_path : '1' ,
                'created_emp' => '11111',
                'updated_emp' => '11111'
            ];
             Teacher::insert($new_teacher_data);

            #teacher_skill create
            if($request->skills != null){
                $teacher_skills = [];
                foreach($request->skills as $skill){
                    array_push($teacher_skills,[
                        'teacher_id' => $new_teacher_id,
                        'skill_id' =>  $skill,
                    ]);
                }
                DB::table('teacher_skills')->insert($teacher_skills );
            }
            DB::commit();
            return response()->json(['status' => 'OK' , 'message' => 'Teacher created successfully.'],200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['status' => 'NG' , 'message' => $e->getMessage()],200);
        }
    }


    function details($id){
       
        // dd($teachers->toArray());
        //  return response()->json(['status' => 'OK' , 'data' => $teachers],200);
        try {
            $teacher = Teacher::with(['skill'=>function($query){
                $query->select('skill.name');
            }])->find($id);
            if($teacher){
                return response()->json(['status' => 'OK' , 'data' => $teacher],200);
            }else{
                return response()->json(['status' => 'NG' , 'message' => 'No data found'],200);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 'NG' , 'message' => $e->getMessage()],200);
        }
        return response()->json(['status' => 'OK' , 'message' => 'Teacher details '],200);
    }

    function delete($id){
        // return response()->json(['status' => 'OK' , 'message' => 'Deleted teacher successfully.'],200);
        try {
            $teacher = Teacher::find($id);
            if($teacher){
                // unlink(storage_path('app/public/'.$teacher->avatar));
                DB::table('teacher_skills')->where('teacher_id',$teacher->student_id)->delete();
                $teacher->forceDelete();
                return response()->json(['status' => 'OK' , 'message' => 'Deleted teacher successfully.'],200);
            }else{
                return response()->json(['status' => 'NG' , 'message' => 'No data found'],200);
            }

        } catch (\Exception $e) {
            // DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['status' => 'NG' , 'message' => $e->getMessage()],200);
        }
    }
    function search(){
        try {
            $search = request()->search;
            $type = request()->type;
        
            switch ($type) {
                case 0:
                    $teachers = Teacher::where ( "name", "LIKE", "%" . $search . "%" )->orWhere("email", "LIKE", "%" . $search . "%" )->orWhere("teacher_id", "LIKE", "%" . $search . "%" )->orWhere("career_path", "LIKE", "%" . $search . "%" )->paginate(10);
                    break;
                case 1:
                    $teachers = Teacher::where("name", "LIKE", "%" . $search . "%" )->paginate(10);
                    break;
                case 2:
                    $teachers = Teacher::where("teacher_id", "LIKE", "%" . $search . "%" )->paginate(10);
                    break;
                case 3:
                    $teachers = Teacher::where ( "name", "LIKE", "%" . $search . "%" )->paginate(10);
                    break;
                case 4:
                    $teachers = Teacher::where ( "email", "LIKE", "%" . $search . "%" )->paginate(10);
                    break;
            }

            return response()->json(['status' => 'OK' , 'data' => $teachers],200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['status' => 'NG' , 'message' => $e->getMessage()],200);
        }
        return response()->json(['status' => 'OK' , 'message' => 'Student search'],200);
    }
    function update(Request $request,$id){
        try {
            $teacher = DB::table('teacher')->where('deleted_at',null)->find($id);
            if(!$teacher){
                DB::beginTransaction();
                // if($request->hasFile('avatar')){#image upload
                //     // unlink(storage_path('app/public/'.$teacher->avatar)); #delete old avatar
                //     // $file = $request->file('avatar');
                //     // $filenameWithExt = $request->file('avatar')->getClientOriginalName();
                //     // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //     // $extension = $request->file('avatar')->getClientOriginalExtension();
                //     // $fileNameToStore = $filename.'.'.$extension;
                //     // Storage::disk('local')->put( $fileNameToStore, file_get_contents($file));
                // }
                $update_teacher_data = [
                    'name' => $request->name,
                    'father_name' => $request->father_name,
                    'nrc_number' => $request->nrc_number,
                    'phone_no' => $request->phone_no,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    //'avatar' => isset($fileNameToStore) ? $fileNameToStore : $teacher->avatar,
                    'address' => $request->address,
                    'carrer_path' => $request->career_path,
                    'created_emp' => '11111',
                    'updated_emp' => '11111',

                ];
               // Log::info($update_teacher_data);
                Teacher::where('teacher_id',$id)->update($update_teacher_data);

                #teacher skill create
                Teacher_skill::where('teacher_id',$teacher->teacher_id)->delete(); #delete old skills
                if($request->skills != null){
                    $teacher_skills = [];
                    foreach($request->skills as $skill){
                        array_push($teacher_skills,[
                            'teacher_id' => $teacher->teacher_id,
                            'skill_id' =>  $skill,
                            'created_emp' => '11111',
                            'updated_emp' => '11111',
                            'updated_at' => now()
                        ]);
                    }
                    DB::table('teacher_skills')->insert($teacher_skills);
                }
                DB::commit();
                return response()->json(['status' => 'OK' , 'message' => 'Updated teacher successfully.'],200);
            }else{
                return response()->json(['status' => 'NG' , 'message' => 'No data found'],200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['status' => 'NG' , 'message' => $e->getMessage()],200);
        }
    }
}
