<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Transaction;
use App\User, App\Router, App\UserHasPackage, App\Role, App\Package, App\TransactionHasModified;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;


class AllTransactionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {


        $arrSelect = [
            'users_has_packages.id',
            'users.username as name',
            'transactions.expired_date as expired_date',
            'packages.name as package_name',
            'transactions.price as price',
            'transactions.status as status',
            // 'trasanction_has_modified.transaction_id as transaction_modified'
        ];
        $data = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->join('transactions', 'users_has_packages.id', '=', 'transactions.users_has_packages_id')
        // ->join('transaction_has_modified', 'transactions.id', 'transaction_has_modified.transaction_id')
   
        ->orderBy('transactions.expired_date','desc')
        ->select($arrSelect)
        ->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'id',
            'Username',
            'Expired Date',
            'Package Name',
            'Price',
            'Status',
        ];
    }
}