<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";        
    protected $primaryKey = "id";


    CONST PRIORITY_LOW = '1';
    CONST PRIORITY_MEDIUM = '2';
    CONST PRIORITY_HIGH = '3';

    protected $fillable = [
        'id',         
        'users_has_packages_id',
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
