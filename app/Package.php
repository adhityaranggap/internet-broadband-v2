<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User, App\UserHasPackage;
class Package extends Model
{
    protected $table = "packages";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',   
        'name',
        'upload',
        'download',
        'upload_unit',
        'download_unit',
        'ip_gateway',
        'ip_pool_start',
        'ip_pool_end',
        'price',
        'created_at',
        'updated_at'
        ];
    public function User()
        {
            return $this->belongsToMany('App\UserHasPackage');
        }
}
