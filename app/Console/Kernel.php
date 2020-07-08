<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use \RouterOS\Client;
use App\Router;
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
        $schedule->call(function() {

        $arrSelect = [
            'users.username as name',
            'transactions.expired_date as expired_date',
            'packages.name as package_name',
            'transactions.price as price',
            'transactions.id as id',
            'transactions.status as status',
            'users.role_id'
        ];
        // $data = transaction::all();
        $data = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->join('transactions', 'users_has_packages.id', '=', 'transactions.users_has_packages_id')
        ->orderBy('transactions.expired_date','desc')
        ->select($arrSelect)
        ->get();

        $router = Router::all()
        ->where('router_name', 'VPN-Server')
        ->first();
        
        $encryptedValue = $router->password;
        $decrypted = Crypt::decryptString($encryptedValue);
       
        $client = new Client([
            'host' => $router->host,
            'port' => $router->port,
            'user' => $router->user,
            'pass' => $decrypted
        ]);

        $status = $data->status;
        if($status == \EnumTransaksi::STATUS_BELUM_BAYAR){
            
        }else if($status == \EnumTransaksi::STATUS_TENGGANG){
            $query = new Query('/ppp/secret/print');
            $query->where('name', $data->name);
            $secrets = $client->query($query)->read();
    
            // Parse secrets and set password
            foreach ($secrets as $secret) {
    
                // Change password
                $query = (new Query('/ppp/secret/set'))
                    ->equal('.id', $secret['.id'])
                    ->equal('profile', 'Block');
    
            // Update query ordinary have no return
            $client->query($query)->read();
            }
        }
                
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
