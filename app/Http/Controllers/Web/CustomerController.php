<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\User, App\Role;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('cms.users.customer.index');
    }

    public function datatables()
    {       
    
        $data = User::all();

        return Datatables::of($data)  
        ->editColumn('name',
            function ($data){
                return $data->name;
        })     
        ->editColumn('username',
            function ($data){
                return $data->username;
        })         
        ->editColumn('contact_person',
            function ($data){
                return $data->contact_person;
        })               
        ->editColumn('Address',
            function ($data){
                return $data->address;
        })   
              
        ->editColumn('action',
            function ($data){                                
            
                    return
                    // \Component::btnDetailPaket(route('customer-detail'), 'Detail Customer').
                    \Component::btnUpdate(route('customer-edit', $data->id), 'Ubah Customer '. $data->name).
                    \Component::btnDelete(route('customer-destroy', $data->id), 'Hapus Customer '. $data->name);
                    
        })
        ->addIndexColumn()
        // ->rawColumns(['action']) 
        ->make(true);          
    }

    /**x
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.users.customer.create');
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
    		'username'       => 'required|max:50',
            'address'        => 'required|max:100',
            'name'           => 'required|max:50', 
            'password'       => 'required|min:8', 
            'email'          => 'required|email', 
            'contact_person' => 'required', 
        ]);
        $request['role_id'] = Role::ROLE_CUSTOMER;

        User::create($request->except('_token'));
 
        
    }

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('users_has_packages')
            ->join('users','users_has_packages.user_id','users.id')
            ->join('packages','users_has_packages.package_id','packages.id')
            ->select('users_has_packages.id as id', 'users.username', 'packages.name', 'users.email', 'packages.price')->where('users.username', 'like', '%' . $cari . '%')->get();

            return response()->json($data);
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
        $data = array();
        $data['user'] = User::where('id', $id)->first();
        
        $data['package'] = DB::table('users_has_packages')
            ->join('packages','users_has_packages.package_id','packages.id')
            ->select('packages.name as package_name','packages.speed', 'packages.price')
            ->where('users_has_packages.user_id', $data['user']->id)
            ->get();

            
        return view('cms.users.customer.edit', compact ('data'));
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

        $data = User::where('id', $id)->first();
        $this->validate($request,[
            'username'   =>  'required|max:255|string|unique:users,username,'.$data->id,
            'name'        =>  'required|max:255|string',
            'address'      =>  'required|max:255|string'
        ]);

        

        
        if($data)
        {
            User::where('id', $id)->update($request->only('username','name','address'));
            return "Data Berhasil di Update";

        }else{
            return false;
        }


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
	$user= User::where('id', $id)->first();
        
    if (is_null($user)){
        return 'tidak ditemukan';
    }else{
        $user->delete();
       
    }

    }
}
