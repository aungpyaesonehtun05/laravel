<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


          /**
 * To export data to excel
 *
 * @author  aungpyaesonehtun
 * @create  06/06/2022
 * @param collection headings
 * @return Response object
 */

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Teacher::all();
    }
    public function headings(): array
    {
        return [
            "teacher_id", "name", "father_name","nrc_number","phone_no","email","gender","date_of_birth","avatar","address","career_path","deleted_at","created_emp","updated_emp"
        ];
    }
}
