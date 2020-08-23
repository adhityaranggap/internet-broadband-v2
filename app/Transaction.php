<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    protected $table = "transactions";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'users_has_packages_id',
        'notes',
        'expired_date',
        'payment_date',
        'status',
        'price',
        'paid',
        'file',
        'type_payment',
        'fee',
        'transaction_has_modified_id',
        'created_at',
        'updated_at'
        ];
}
