<?php

namespace App\Imports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class AllTransactionImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new Transaction([
            'name'  => $row['name'],
            'email' => $row['email'],
            'at'    => $row['at_field'],
        ]);
    }
}
