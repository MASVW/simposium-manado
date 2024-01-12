<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SheetExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        // Sheet Users
        $sheets[] = new UsersExport();

        // Sheet Transactions
        $sheets[] = new TransactionExport();

        return $sheets;
    }
}
