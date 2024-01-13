<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, WithColumnWidths
{
    use Exportable;
    public function collection()
    {
        $user = User::where('id', 1)->first(['id', 'firstName', 'lastName', 'email', 'birthDate']);

        return $user ? collect([$user->toArray()]) : collect([]);
    }
    public function headings(): array
    {
        return [
            'ID',
            'Nama Depan',
            'Nama Belakang',
            'Email',
            'Tanggal Lahir'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $cellRange = 'A1:E' . $sheet->getHighestRow();
        $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle('thin');
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'A' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_DATE_DATETIME
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 15,
            'D' => 30,
            'E' => 15
        ];
    }
}
