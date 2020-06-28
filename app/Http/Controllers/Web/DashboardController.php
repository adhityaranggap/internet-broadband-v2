<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User, App\Role, App\Transaction, App\Ticket, App\Package;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $customercount = User::all()->where('role_id', Role::ROLE_CUSTOMER)->count();
        $lunascount = Transaction::all()->where('status', \EnumTransaksi::STATUS_LUNAS)->count();
        $ticketcount = Ticket::all()->where('status', \EnumTicket::STATUS_OPEN)->count();
        // $telatcount = Transaction::all()->where('status', \EnumTransaksi::STATUS_LUNAS)->count();
        $telatcount = Transaction::all()->where('status', \EnumTransaksi::STATUS_TENGGANG)->count();
        
        // $data = Transaction::where('type_payment', '!=', '')->orderBy('created_at','desc')->take(5)->get();
        $arrSelect = [
            'users.username as name',
            'transactions.expired_date as expired_date',
            'packages.name as package_name',
            'transactions.paid as paid',
            'transactions.id as id',
            'transactions.status as status',
            'transactions.updated_at as updated_at',
            'users.role_id'
        ];
        // $data = transaction::all();
        $trxrecent = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->join('transactions', 'users_has_packages.id', '=', 'transactions.users_has_packages_id')
        ->where('transactions.type_payment', '!=', '')
        ->orderBy('transactions.updated_at','desc')
        ->select($arrSelect)
        ->take(5)
        ->get();
        // Count Package Usage
        $packages= Package::all();
        $allpackageorders = DB::table('users_has_packages')->get();

        $total = $allpackageorders->count();
        foreach($packages as $key => $package){
            $countThisPackage = 0;

            foreach($allpackageorders as $keyChild => $packageOrder){

                if($packageOrder->package_id == $package->id){
                    $countThisPackage +=1;
                }
            }

            $results[$package->id] = [
                'name'  =>  $package->name,
                'percent'  =>  round($countThisPackage/$total * 100,2),
                'total'  =>  ($countThisPackage)
            ];
        }
        $arrSelect = [
            'users.username as name',
            'packages.name as package_name',
            'users_has_packages.updated_at as updated_at'
          

        ];
        $packagerecent = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->join('transactions', 'users_has_packages.id', '=', 'transactions.users_has_packages_id')
        ->orderBy('users_has_packages.updated_at','desc')
        ->select($arrSelect)
        ->take(3)
        ->get();
        // return $trxrecent;
        // return $results;
        return view('cms.dashboard.index', compact ('packagerecent','results','trxrecent','customercount','lunascount','ticketcount','telatcount'));
    }
}
