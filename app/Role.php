<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'role',
        'created_at',
        'updated_at'
        ];

}
