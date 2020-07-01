<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    protected $table = "routers";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'router_name',
        'host',
        'port',
        'user',
        'password',
        'address',
        'coordinate',
        'created_at',
        'updated_at'
        ];}
