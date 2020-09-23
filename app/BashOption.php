<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BashOption extends Model
{
    protected $table = "bash_options";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'name',
        'value',
        'default_name',
        'description',
        'created_at',
        'updated_at'
        ];
}
