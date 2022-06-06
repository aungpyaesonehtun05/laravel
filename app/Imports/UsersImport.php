<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Foundation\Auth\User;

class UsersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
                'teacher_id' => $row['teacher_id'],
                'name' => $row['name'],
                'father_name' => $row['father_name'],
                'nrc_number' => $row['nrc_number'],
                'phone_no' => $row['phone_no'],
                'email' => $row['email'],
                'gender' => $row['gender'],
                'date_of_birth' => $row['date_of_birth'],
                'avatar' => $row['avatar'] ,
                'address' => $row['address'],
                'carrer_path' => $row['carrer_path'] ,
                'created_emp' => $row['created_emp'],
                'updated_emp' => $row['updated_emp'],


        ]);
    }
}
