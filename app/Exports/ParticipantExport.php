<?php

namespace App\Exports;

use App\Models\Datas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ParticipantExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithColumnFormatting, WithTitle
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $numberedParticipants = [];
        $i = 1;
        
        $participants = Datas::where('events_id', $this->request->id)
            ->with('positions', 'events')
            ->get();
        foreach ($participants as $a) {
            $numberedParticipant = [
                'No' => $i,
                'Nama Lengkap' => $a->fullName,
                'Email' => $a->email,
                'No. Resi' => $a->payments_id,
                'Pekerjaan' => $a->positions->desc,
                'Acara' => $a->events->eventName,
            ];
            $numberedParticipants[] = $numberedParticipant;
            $i++;
        };
        return collect($numberedParticipants);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Email',
            'No. Resi',
            'Pekerjaan',
            'Acara'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $cellRange = 'A1:F' . $sheet->getHighestRow();
        $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle('thin');
    }

    
    public function columnFormats(): array
    {
        return [
            "A" => NumberFormat::FORMAT_NUMBER,
            "B" => NumberFormat::FORMAT_TEXT,
            "C" => NumberFormat::FORMAT_TEXT,
            "D" => NumberFormat::FORMAT_NUMBER,
            "E" => NumberFormat::FORMAT_TEXT,
            "F" => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function columnWidths(): array
    {
        return [ 
            "A" =>5,
            "B" =>25,
            "C" =>30,
            "D" =>20,
            "E" =>20,
            "F" =>50,
        ];
    }

    public function title(): string
    {
        return $this->request->eventName;
    }
}
