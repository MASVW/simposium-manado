<?php

namespace App\Exports;

use App\Models\Payment;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting, WithColumnWidths
{
    use Exportable;

    public function collection()
    {
        $items = Payment::all(
            [
            'id',
            'users_id',
            'status',
            'metode',
            'total',
            'created_at',
            ]
        );
        $items->transform(function ($item) {
            $item->created_at = Carbon::parse($item->created_at)->format('d-m-Y H:i:s');
            return $item;
        });
        return $items ? collect([$items->toArray()]) : collect([]);;
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'User ID',
            'Status',
            'Metode',
            'Total',
            'Tanggal',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menambahkan garis pada sel-sel tabel
        $cellRange = 'A1:F' . $sheet->getHighestRow();
        $sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle('thin');
    }
    
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER, // Format column A as text
            'B' => NumberFormat::FORMAT_NUMBER, // Format column A as text
            'C' => NumberFormat::FORMAT_TEXT, // Format column A as text
            'D' => NumberFormat::FORMAT_TEXT, // Format column A as text
            'E' => NumberFormat::FORMAT_NUMBER_00, // Format column A as text
            'F' => NumberFormat::FORMAT_DATE_DATETIME, // Format column A as text
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 18, 
            'B' => 10, 
            'C' => 10, 
            'D' => 15, 
            'E' => 15, 
            'F' => 20, 
        ];
    }
}
