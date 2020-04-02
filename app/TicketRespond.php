<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketRespond extends Model
{
    protected $table = "ticket_respond";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'user_id',
        'respond',
        'created_at',
        'updated_at'
        ];
}
