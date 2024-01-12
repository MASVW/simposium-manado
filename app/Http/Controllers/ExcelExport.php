<?php

namespace App\Http\Controllers;

use App\Exports\SheetExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExport extends Controller
{
    public function exportUser(){
        return Excel::download(new SheetExport, 'users.xlsx');
    }
}
