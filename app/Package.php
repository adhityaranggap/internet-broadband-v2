<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = "packages";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'name',
        'speed',
        'price',
        'created_at',
        'updated_at'
        ];
}
