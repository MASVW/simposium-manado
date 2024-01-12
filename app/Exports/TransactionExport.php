<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromCollection, WithHeadings 
{
    use Exportable;
    public function collection()
    {
        return Payment::all();
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
}
