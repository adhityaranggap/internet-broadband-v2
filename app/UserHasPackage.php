<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasPackage extends Model
{
    protected $table = "users_has_packages";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'user_id',
        'package_id',
        'verification',
        'status',
        'notes',
        'created_at',
        'updated_at'
        ];

   
}
