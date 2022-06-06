<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StudentRequest;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function student_reg(StudentRequest $request)
    {
        try {
            DB::beginTransaction();
            #student create
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $filenameWithExt = $request->file('avatar')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                Storage::disk('local')->put( $fileNameToStore, file_get_contents($file));
            }
            $last_student = DB::table('student')->latest()->first();
           
            $new_student_id = $last_student ? ++$last_student->student_id:'1001';
            $new_student_data = [
                'student_id' => $new_student_id,
                'name' => $request->name,
                'father_name' => $request->father_name,
                'nrc_number' => $request->nrc_number,
                'phone_no' => $request->phone_no,
                'email' => $request->email,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'avatar' => isset($fileNameToStore) ? $fileNameToStore : null ,
                'address' => $request->address,
                'career_path' => isset($request->career_path) ? $request->career_path : '1' ,
                'created_emp' => '1001',
                'updated_emp' => '1001'
            ];
            Student::insert($new_student_data);

            #student_skill create
            if($request->skill != null){
                $student_skills = [];
                foreach($request->skill as $skill){
                    array_push($student_skills,[
                        'student_id' => $new_student_id,
                        'skill_id' =>  $skill,
                        'created_emp' => '1001',
                        'updated_emp' => '1001',
                    ]);
                }
                DB::table('student_skill')->insert($student_skills);
            }
            DB::commit();
            return response()->json(['status' => 'OK' , 'message' => 'Student created successfully.'],200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['status' => 'NG' , 'message' => $e->getMessage()],200);
        }
    }

    function details($id){
        try {
            $student = DB::table('student')
            ->where('id',$id)
            ->first();
            $student_skills_ids = DB::table('student_skill')->where('student_id',$student->student_id)->pluck('skill_id');
            $skills = DB::table('skill')->whereIn('id',$student_skills_ids)->pluck('name');
            $student->skill = $skills;
            return response()->json(['status' => 'OK' , 'message' =>$student],200);
            if($student){
                return response()->json(['status' => 'OK' , 'message' => $student],200);
            }else{
                return response()->json(['status' => 'NG' , 'message' => 'No data found'],200);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 'NG' , 'message' => $e->getMessage()],200);
        }
        
    }

    function delete($id){
        try {
            $student = Student::find($id);
            if($student){
                unlink(storage_path('app/public'.$student->avatar));
                Student::where('student_id',$student->student_id)->delete();
                $student->delete();
                return response()->json(['status' => 'OK' , 'message' => 'Deleted student successfully.'],200);
            }else{
                return response()->json(['status' => 'NG' , 'message' => 'No data found'],200);
            }

        } catch (\Exception $e) {
            DB::rollBack();
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
                    $students = Student::where ( "name", "LIKE", "%" . $search . "%" )->orWhere("email", "LIKE", "%" . $search . "%" )->orWhere("student_id", "LIKE", "%" . $search . "%" )->orWhere("career_path", "LIKE", "%" . $search . "%" )->get ();
                    break;
                case 1:
                    $students = Student::where("name", "LIKE", "%" . $search . "%" )->get ();
                    break;
                case 2:
                    $students = Student::where("student_id", "LIKE", "%" . $search . "%" )->get ();
                    break;
                case 3:
                    $students = Student::where ( "name", "LIKE", "%" . $search . "%" )->get ();
                    break;
                case 4:
                    $students = Student::where ( "email", "LIKE", "%" . $search . "%" )->get ();
                    break;
            }

            // dd($students);
            return response()->json(['status' => 'OK' , 'data' => $students],200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->json(['status' => 'NG' , 'message' => $e->getMessage()],200);
        }
        return response()->json(['status' => 'OK' , 'message' => 'Student search'],200);
    }

    function update(StudentRequest $request,$id){
        try {
            $student = DB::table('student')->where('deleted_at',null)->where('student_id',$id)->first();
            if($student){
                DB::beginTransaction();
                if($request->hasFile('avatar')){   //image upload
                    unlink(storage_path('app/public/'.$student->avatar));   //delete old avatar
                    $file = $request->file('avatar');
                    $filenameWithExt = $request->file('avatar')->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('avatar')->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    Storage::disk('local')->put( $fileNameToStore, file_get_contents($file));
                }
            
                
                $update_student_data = [
                    'name' => $request->name,
                    'father_name' => $request->father_name,
                    'nrc_number' => $request->nrc_number,
                    'phone_no' => $request->phone_no,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'avatar' => isset($fileNameToStore) ? $fileNameToStore : $student->avatar,
                    'address' => $request->address,
                    'carrer_path' => $request->carrer_path,
                    'created_emp' => '1001',
                    'updated_emp' => '1001'
                ];
                DB::table('student')->update($update_student_data);

                #student_skill create
                DB::table('student_skill')->where('student_id',$student->student_id)->delete();
                if($request->skills != null){
                    $student_skills = [];
                    foreach($request->skill as $skill){
                        array_push($student_skills,[
                            'student_id' => $student->student_id,
                            'skill_id' =>  $skill,
                            'created_emp' => '1001',
                            'updated_emp' => '1001'
                        ]);
                    }
                    DB::table('student_skill')->insert($student_skills);
                }
                DB::commit();
                return response()->json(['status' => 'OK' , 'message' => 'Updated student successfully.'],200);
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