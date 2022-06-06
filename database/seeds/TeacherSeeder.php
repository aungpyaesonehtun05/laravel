<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teacher')->insert(array([
            'teacher_id'=> '10001',
            'name' =>'chan',
            'father_name' =>'ken',
            'nrc_number'=>'8/YaGaNa(N)279159',
            'phone_no'=>'09761273166',
            'email'=>'chan@gmail.com',
            'gender'=>'2',
            'date_of_birth'=> date('Y/m/d',mktime(0,0,0,2,11,2000)),
            'address'=>'yangon',
            'carrer_path'=>'1',
            'created_emp'=>'1',
            'updated_emp'=>'2'
        
    ]));
}
}
