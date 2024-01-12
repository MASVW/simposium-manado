<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
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
}
