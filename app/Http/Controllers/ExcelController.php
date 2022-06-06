<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


          /**
 * To create excel file
 *
 * @author  aungpyaesonehtun
 * @create  06/06/2022
 * @param Controller
 * @return view,export,import
 */

class ExcelController extends Controller
{
    public function importExportView()
    {
       return view('import');
    }
   
    public function export() 
    {
        return Excel::download(new UsersExport, 'teachers_'.Carbon::now().'.xlsx');
    }
   
    public function import() 
    {
        Excel::import(new UsersImport,request()->file('excel_file'));
           
        return response()->json(['status' => 'OK' , 'message' => 'Teacher created successfully.'],200);
    }
}
