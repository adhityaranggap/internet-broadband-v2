<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User, App\Role, App\Router;
use \RouterOS\Client;
use \RouterOS\Query;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;



class ActiveUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       return view ('cms.users.activeuser.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function datatables()
    {       
    
        // // // $data = Router::all()
        // // // ->where('router_name', 'VPN-Server')
        // // // ->first();
        
        // // // $encryptedValue = $data->password;
        // // // $decrypted = Crypt::decryptString($encryptedValue);


       
        // // // $client = new Client([
        // // //     'host' => $data->host,
        // // //     'port' => $data->port,
        // // //     'user' => $data->user,
        // // //     'pass' => $decrypted
        // // // ]);

        // // // // Create "where" Query object for RouterOS
        // // // // $query =
        // // // //     (new Query('/ppp/active/print'));
        // // // $query = new Query('/ppp/secret/print');
        // // // $query->where('name', 'ari-rt05');
        // // // $secrets = $client->query($query)->read();

        // // // // Parse secrets and set password
        // // // foreach ($secrets as $secret) {

        // // //     // Change password
        // // //     $query = (new Query('/ppp/secret/set'))
        // // //         ->equal('.id', $secret['.id'])
        // // //         ->equal('profile', 'Block');

        // // // // Update query ordinary have no return
        // // // $client->query($query)->read();
        // // }
        //         // ->where('name', 'adit');

        // // Send query and read response from RouterOS

        // $response = $client->query($query)->read();
        //  $response = [
        //     $api->name,
        // ];
        // if (empty(!$response)) { 
        // return $response;
        // ===========================
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
        ->where('transactions.status', 1)
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

        $status = $data['status'];
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
        // ===========================
        return Datatables::of($response) 
        ->editColumn('name',
            function ($response){
                return $response['name'];
        })     
        ->editColumn('address',
            function ($response){
                return $response['address'];
        })         
             
        ->editColumn('uptime',
            function ($response){
                return $response['uptime'];
        })   
              
        // ->editColumn('action',
        //     function ($response){                                
            
        //             // \Component::btnDetailPaket(route('customer-detail'), 'Detail Customer').
        //             // \Component::btnUpdate(route('customer-edit', $data->id), 'Ubah Customer '. $data->name).
        //             // \Component::btnDelete(route('customer-destroy', $data->id), 'Hapus Customer '. $data->name);
                    
        // })
        ->addIndexColumn()
        // ->rawColumns(['action']) 
        ->make(true);     
        // }else{
        //     return 'kosong';
        // }     ;
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
