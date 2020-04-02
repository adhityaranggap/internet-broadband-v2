<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'customer_has_package_id',
        'subject',
        'description',
        'priority',
        'attachment',
        'status',
        'ticket_number',
        'created_at',
        'updated_at'
        ];
}
