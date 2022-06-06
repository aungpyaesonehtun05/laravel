<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_controller')->insert([
            'name' =>'xin',
            'fname' =>'han',
            'NRC'=>'8/PaKhaKa(N)279159',
            'Phone no'=>'12345678901',
            'email'=>'xin@gmail.com',
            'address'=>'pakokku',
            'gender'=> '2',
            'Birthday'=>date('Y/m/d',mktime(0,0,0,2,11,2000))
        ]);
    }
}
