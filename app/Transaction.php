<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'user_has_package_id',
        'order_id',
        'notes',
        'transaction_has_modified_id',
        'expired_date',
        'status',
        'price',
        'fee',
        'created_at',
        'updated_at'
        ];
}
