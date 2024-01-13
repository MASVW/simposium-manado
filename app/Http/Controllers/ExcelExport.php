<?php

namespace App\Http\Controllers;

use App\Exports\ParticipantSheetExport;
use App\Exports\SheetExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExport extends Controller
{
    public function exportUser(){
        ob_end_clean();
        ob_start(); 
        return Excel::download(new SheetExport, 'SM_Data.xlsx');
    }
    public function exportParticipant(Request $request){
        ob_end_clean();
        ob_start(); 
        return Excel::download(new ParticipantSheetExport($request), 'SM_Participant_' . $request->eventName . '.xlsx');
    }
}

?>
