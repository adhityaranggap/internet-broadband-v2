<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "review";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'users_has_packages_id',
        'review',
        'star',
        'created_at',
        'updated_at'
        ];
}
