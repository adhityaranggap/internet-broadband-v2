<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionHasModified extends Model
{
    protected $table = "transaction_has_modified";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'transaction_id',
        'modified_by',
        'created_at',
        'updated_at'
        ];
}
