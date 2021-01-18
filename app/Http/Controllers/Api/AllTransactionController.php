<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Transaction;
// use Veritrans_Config;
// use Veritrans_Snap;
// use Veritrans_Notification;

class AllTransactionController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

    }
    public function notification(){
        $notif = new \Midtrans\Notification();
        
        DB::transaction(function () use ($notif) {
            $transactionStatus = $notif->transaction_status;
            $paymentType       = $notif->payment_type;
            $paymentDate       = $notif->settlement_time;
            $amountPaid        = $notif->gross_amount;
            $orderId           = $notif->order_id;
            $fraudStatus       = $notif->fraud_status;
            $transaction          = Transaction::where('transaction_code', $orderId)->first();

            if($transactionStatus   == 'capture'){
                if($paymentType     == 'credit _card'){
                    if($fraudStatus == 'challenge'){
                        $transaction->setStatusPending();
                    }else{
                        $transaction->setStatusSuccess();
                    }
                }
            } elseif ($transactionStatus == 'settlement'){
                
                $transaction->setStatusSuccess();
                
                $transaction->update([
                    'type_payment'    => $paymentType,
                    'paid'            => $amountPaid,
                    'payment_date'    => $paymentDate
                ]);
                Transaction::create([
                    'users_has_packages_id'         => $transaction->users_has_packages_id,
                    'transaction_has_modified_id'   => 1,
                    'notes'                         => '-',
                    'expired_date'                  => Carbon::parse($transaction->expired_date)->addMonths(1),
                    'status'                        => \EnumTransaksi::STATUS_BELUM_BAYAR,
                    'price'                         => $transaction->price,
                    'fee'                           => $transaction->fee,
                    'paid'                          => 0,
                    'created_at'                    => now()            
                ]);
                

            } elseif ($transactionStatus == 'pending'){
                $transaction->setStatusPending();
            } elseif ($transactionStatus == 'deny'){
                $transaction->setStatusFailed();
            } elseif ($transactionStatus == 'expired'){
                $transaction->setStatusExpired();
            } elseif ($transactionStatus == 'cancel'){
                $transaction->setStatusCancel();
            }

        });
        return;
    }
}
