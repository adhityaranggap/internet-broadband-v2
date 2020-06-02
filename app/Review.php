<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "review";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'user_has_package_id',
        'review',
        'star',
        'created_at',
        'updated_at'
        ];
}
