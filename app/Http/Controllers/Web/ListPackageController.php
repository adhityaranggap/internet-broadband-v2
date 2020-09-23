<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use App\Package, App\Role, App\Router;
use \RouterOS\Client;
use \RouterOS\Query;
use Illuminate\Support\Facades\DB;


class ListPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.packages.listpackage.index');
    }
    public function datatables()
    {       
    
        $data = Package::all();
    
        return Datatables::of($data)  
        ->editColumn('name',
            function ($data){
                return $data->name;
        })       
        ->editColumn('price',
            function ($data){
                return $data->price;
        })               
              
        ->editColumn('action',
            function ($data){                                
            
                    return
                    //\Component::btnRead('#', 'Detail Customer').
                    \Component::btnUpdate(route('list-package-edit', $data->id), 'Ubah Package '. $data->name).
                    \Component::btnDelete(route('list-package-destroy', $data->id), 'Hapus Package '. $data->name);
                    
        })
        ->addIndexColumn()
        // ->rawColumns(['action']) 
        ->make(true);          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.packages.listpackage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
   	        'name'          => 'required|string|max:255',
            'upload'        => 'required|numeric',
            'download'      => 'required|numeric',
            'ip_gateway'    => 'required|string',
            'ip_pool_start' => 'required|string',
            'ip_pool_end'   => 'required|string',
            'price'         => 'required|numeric|digits_between:1,10'
        ]);
        
        //create to database
        Package::create($request->except('_token'));
        //create package to router
        $id = DB::getPDO()->lastInsertId();
        $package = Package::where('id', $id)->first();
        $ip_pool = $package->ip_pool_start .'-'. $package->ip_pool_end;
        $speed = $package->download . $package->download_unit .'/'. $package->upload . $package->upload_unit;
        
        $routers = Router::all();
        
        foreach($routers as $key => $router){
            $encryptedValue = $router->password;
            $decrypted = Crypt::decryptString($encryptedValue);
           
            $client = new Client([
                'host' => $router->host,
                'port' => $router->port,
                'user' => $router->user,
                'pass' => $decrypted
            ]);
            $query = (new Query('/ip/pool/add'))
            ->equal('name', $package->name)
            ->equal('ranges', $ip_pool);

            // $query = (new Query('/ppp/profile/add'))
            // ->equal('name', $package->name);
           $client->query($query)->read();
            
            $query = (new Query('/ppp/profile/add'))
            ->equal('name', $package->name)
            ->equal('local-address', $package->ip_gateway)
            ->equal('dns-address', $package->ip_gateway)
            ->equal('remote-address', $package->name)
            ->equal('rate-limit', $speed);

            // $query = (new Query('/ppp/profile/add'))
            // ->equal('name', $package->name);
            $response = $client->query($query)->read();
            


        }
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
        $data = Package::where('id', $id)->first();
        return view('cms.packages.listpackage.edit', compact ('data'));
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
        $data = Package::where('id', $id)->first();
        $this->validate($request,[
            'name'          => 'required|string|max:255',
            'upload'        => 'required|string|max:15',
            'download'      => 'required|string|max:15',
            'ip_gateway'    => 'required|string|max:15',
            'ip_pool_start' => 'required|string|max:15',
            'ip_pool_end'   => 'required|string|max:15',
            'price' => 'required|numeric|digits_between:1,10'

        ]);

        
        if($data){
            Package::where('id', $id)->update($request->only('name', 'package', 'price'));
        }
        
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     // menghapus data pegawai berdasarkan id yang dipilih
	$data= Package::where('id', $id)->first();
        
    if (is_null($data)){
        return 'tidak ditemukan';
    }else{
        $data->delete();
       
    }
    }
}