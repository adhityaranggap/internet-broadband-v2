<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Review;
use Illuminate\Support\Facades\DB;

class AllReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.review.index');
    }

    public function datatables()
    {       
    
        // $data = Review::all();
        $arrSelect = [
            'packages.name as package_name',
            'users_has_packages.id as users_has_packages_id',
            'users.username as username',
            'review.star as star',
            'review.review',
            'review.id as id'
        ];
        $data = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->join('review','users_has_packages.id','=','review.users_has_packages_id')
        ->select($arrSelect)
        ->get();

        return Datatables::of($data)  
        ->editColumn('username',
            function ($data){
                return $data->username;
        })     
        ->editColumn('review',
            function ($data){
                return $data->review;
        })                       
        ->editColumn('package_name',
            function ($data){
                return $data->package_name;
        })                       
        ->editColumn('star',
            function ($data){
                return $data->star;
        })                       
        ->editColumn('action',
            function ($data){                                
            
                    return
                    // \Component::btnDetailPaket(route('customer-detail'), 'Detail Customer').
                    // \Component::btnUpdate(route('review-edit', $data->id), 'Ubah Customer '. $data->name).
                    \Component::btnDelete(route('review-destroy', $data->id), 'Hapus Review '. $data->review);
                    
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
        $packages = DB::table('users_has_packages')
        ->where('users_has_packages.user_id', auth()->user()->id)
        ->join('packages', 'users_has_packages.package_id', 'packages.id') 
        ->select([
            'packages.name as name',
            'users_has_packages.id as users_has_packages_id'
        ])
        ->get();
        

    return view('cms.review.create', compact ('packages'));   
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Review::create($request->except('_token'));
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
        $data= Review::where('id', $id)->first();
        
        if (is_null($data)){
            return 'tidak ditemukan';
        }else{
            $data->delete();
           
        }    }
}
