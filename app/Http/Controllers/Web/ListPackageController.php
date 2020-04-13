<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Package, App\Role;

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
    
        $data = package::all();

        return Datatables::of($data)  
        ->editColumn('name',
            function ($data){
                return $data->name;
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
    		'name' => 'required',
            'speed' => 'required',
            'price' => 'required'
        ]);

        Package::create($request->except('_token'));
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
            'name'      =>  'required|max:255|string',
            'speed'  =>  'required|max:255|string,',
            'price'  =>  'required|max:10|integer,',

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