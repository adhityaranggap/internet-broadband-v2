<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use \RouterOS\Client;
use \RouterOS\Query;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $arrSelect = [
        //     'users.username as name',
        //     'transactions.expired_date as expired_date',
        //     'packages.name as package_name',
        //     'transactions.price as price',
        //     'transactions.id as id',
        //     'transactions.status as status',
        //     'users.role_id'
        // ];
        // // $data = transaction::all();
        // $data = DB::table('users')
        // ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        // ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        // ->join('transactions', 'users_has_packages.id', '=', 'transactions.users_has_packages_id')
        // ->orderBy('transactions.expired_date','desc')
        // ->select($arrSelect)
        // ->get();
        // $status = $data->status;
        // if($status == \EnumTransaksi::STATUS_BELUM_BAYAR){
            
        // }else if($status == \EnumTransaksi::STATUS_TENGGANG){
        //     $client = new Client([
        //         'host' => 'indonesianet.id',
        //         'port' =>  8721,
        //         'user' => 'rangga',
        //         'pass' => 'Botolkecap1!'
        //     ]);
    
        //     // Create "where" Query object for RouterOS
        //     $query =
        //         (new Query('/ppp/secret/set/',$data->name,'/profile=Block'));
        //             // ->where('name', 'adit');
    
        //     // Send query and read response from RouterOS
    
        //     $response = $client->query($query)->read();
        //     return response()->json($response);      
        
        $schedule->call(function() {
        $client = new Client([
            'host' => 'indonesianet.id',
            'port' =>  8721,
            'user' => 'rangga',
            'pass' => 'Botolkecap1!'
        ]);

        // Create "where" Query object for RouterOS
        $query =
            (new Query('/ppp/secret/set/ari-rt05/profile=Block'));
                // ->where('name', 'adit');

        // Send query and read response from RouterOS

        $response = $client->query($query)->read();
        return response()->json($response);          
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
