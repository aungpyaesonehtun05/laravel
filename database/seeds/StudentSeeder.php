<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->insert(array([
            'student_id'=> '1001',
            'name' =>'xin',
            'father_name' =>'ken',
            'nrc_number'=>'8/PaKhaKa(N)279159',
            'phone_no'=>'092300779',
            'email'=>'xin@gmail.com',
            'gender'=>'1',
            'date_of_birth'=> date('Y/m/d',mktime(0,0,0,2,11,2000)),
            'address'=>'pakokku',
            'carrer_path'=>'3',
            'created_emp'=>'1',
            'updated_emp'=>'2'
        ],
        [
            'student_id'=> '1002',
            'name' =>'ri',
            'father_name' =>'rin',
            'nrc_number'=>'8/PaKhaKa(N)152886',
            'phone_no'=>'00761273266',
            'email'=>'ri@gmail.com',
            'gender'=>'2',
            'date_of_birth'=> date('Y/m/d',mktime(0,0,0,2,24,2000)),
            'address'=>'pakokku',
            'carrer_path'=>'1',
            'created_emp'=>'2',
            'updated_emp'=>'2' 
        ],
    [
        'student_id'=> '1002',
            'name' =>'jim',
            'father_name' =>'gin',
            'nrc_number'=>'8/PaKhaKa(N)1521486',
            'phone_no'=>'0978654456',
            'email'=>'jim@gmail.com',
            'gender'=>'1',
            'date_of_birth'=> date('Y/m/d',mktime(0,0,0,2,22,2000)),
            'address'=>'pakokku',
            'carrer_path'=>'2',
            'created_emp'=>'3',
            'updated_emp'=>'4' 
    ]));
    }
}
