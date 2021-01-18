<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    protected $table = "transactions";        
    protected $primaryKey = "id";

    protected $fillable = [
        'id',         
        'users_has_packages_id',
        'notes',
        'expired_date',
        'payment_date',
        'payment_type',
        'status',
        'price',
        'paid',
        'file',
        'type_payment',
        'fee',
        'transaction_has_modified_id',
        'transaction_code',
        'snap_token',
        'created_at',
        'updated_at'
        ];
        public function setStatusPending()
        {
            $this->attributes['status'] = \EnumTransaksi::STATUS_VERIFIKASI;
            self::save();
        }
    
        /**
         * Set status to Success
         *
         * @return void
         */
        public function setStatusSuccess()
        {
            $this->attributes['status'] = \EnumTransaksi::STATUS_LUNAS;
            self::save();
        }
    
        /**
         * Set status to Failed
         *
         * @return void
         */
        public function setStatusFailed()
        {
            $this->attributes['status'] = \EnumTransaksi::STATUS_FAILED;
            self::save();
        }
    
        /**
         * Set status to Expired
         *
         * @return void
         */
        public function setStatusExpired()
        {
            $this->attributes['status'] = \EnumTransaksi::STATUS_EXPIRED;
            self::save();
        }
}
