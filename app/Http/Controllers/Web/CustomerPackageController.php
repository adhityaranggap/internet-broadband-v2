<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use DataTables; 
use App\User, App\UserHasPackage, App\Package, App\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.packages.customerpackage.index');
    }
    public function datatables()
    {       
    
        $arrSelect = [
            'users.username as username',
            'users_has_packages.id as id',
            'packages.name as package_name',
            'packages.speed as speed',
            'packages.price as price'
        ];
        // $data = transaction::all();
        $data = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->orderBy('users_has_packages.created_at','desc')
        ->select($arrSelect)
        ->get();
        return Datatables::of($data)  
        ->editColumn('username',
            function ($data){
                return $data->username;
        })     
        ->editColumn('package_name',
            function ($data){
                return $data->package_name;
        })         
        ->editColumn('speed',
            function ($data){
                return $data->speed;
        })         
        ->editColumn('price',
            function ($data){
                return $data->price;
        })               
              
        ->editColumn('action',
            function ($data){                                
            
                    return
                    //\Component::btnRead('#', 'Detail Customer').
                    \Component::btnUpdate(route('customer-package-edit', $data->id), 'Ubah Package '. $data->package_name).
                    \Component::btnDelete(route('customer-package-destroy', $data->id), 'Hapus Package '. $data->package_name);
                    
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

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $data = DB::table('users')
            ->select('id', 'username')->where('users.username', 'like', '%' . $cari . '%')->get();
            
            return response()->json($data);
        }
    }

    public function create()
    {
        $package = Package::all('name', 'id');

        return view('cms.packages.customerpackage.create', compact ('package'));
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
    		'user_id' => 'required|integer|max:100',
            'package_id' => 'required|integer|max:15',
            'note'  => 'nullable',
        ]);
            
        UserHasPackage::create($request->except('_token'));
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
        $arrSelect = [
            'users.username as username',
            'users_has_packages.id as id',
            'packages.name as package_name',
            'packages.speed as speed',
            'packages.id as package_id',
            'packages.price as price'
        ];
        $package = Package::all('name', 'id');
        $data = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->select($arrSelect)
        ->where('users_has_packages.id',$id)
        ->first();
        // $data = UserHasPackage::where('id', $id)->first();
        return view('cms.packages.customerpackage.edit', compact ('data','package'));
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
        $data = UserHasPackage::where('id', $id)->first();
        $this->validate($request,[
            'package_id'  =>  'required|max:10|integer'

        ]);

        
        if($data){
            UserHasPackage::where('id', $id)->update($request->only('package_id'));
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
	$data= UserHasPackage::where('id', $id)->first();
        
    if (is_null($data)){
        return 'tidak ditemukan';
    }else{
        $data->delete();
       
    }
    }
}