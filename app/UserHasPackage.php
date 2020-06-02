<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User, App\Package;

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
        // public function Package()
        // {
        //     return $this->belongsToMany('App\Package');
        // }
        // public function User()
        // {
        //     return $this->belongsToMany('App\User');
        // }
   
}
