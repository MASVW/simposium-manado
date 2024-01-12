<?php

namespace App\Exports;

use App\Models\Payment;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionExport implements FromCollection, WithHeadings, WithStyles
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
}
