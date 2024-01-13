<?php

namespace App\Exports;

use App\Models\Datas;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    use Exportable;
    public function collection()
    {
        $participant = Datas::where('')
            ->get([
                'fullName',
                'email',
            ]);
    }
    public function headings(): array
    {
        return [
            'Number',
            'Nama Lengkap',
            'Posisi',
            'Email',
            'Tanggal Lahir'
        ];
    }
}
