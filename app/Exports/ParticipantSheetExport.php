<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ParticipantSheetExport implements WithMultipleSheets
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function sheets(): array
    {
        $sheets = [];
        
        $sheets[] = new ParticipantExport($this->request);


        return $sheets;
    }
}
