<?php

namespace App\Exports;

use App\Models\Datas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ParticipantExport implements FromCollection, WithHeadings, WithStyles
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $participants = Datas::where('eventName', $this->request->eventName)
            ->get(['fullName', 'email', 'payment_id']);
        return $participants;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Event'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $cellRange = 'A1:C' . $sheet->getHighestRow();
        $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle('thin');
    }
}
