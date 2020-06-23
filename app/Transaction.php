<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'users_has_packages_id',
        'notes',
        'transaction_has_modified_id',
        'expired_date',
        'status',
        'price',
        'paid',
        'file',
        'type_payment',
        'fee',
        'created_at',
        'updated_at'
        ];
}
