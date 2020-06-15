<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ticket; use DataTables; use App\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AllTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.ticket.allticket.index');
    }

    public function datatables()
    {       
    
        $data = Ticket::all();

        return Datatables::of($data)         
        ->editColumn('ticket_number',
            function ($data){
                return $data->ticket_number;
        })               
        ->editColumn('subject',
            function ($data){
                return $data->subject;
        })               
        ->editColumn('last_updated',
    
            function ($data){
                return $data->last_updated;
        })               
        ->editColumn('status',
            function ($data){
                return $data->status;
        })   
              
        ->editColumn('action',
            function ($data){                                
            
                    // return
                    // // \Component::btnDetailPaket(route('customer-detail'), 'Detail Customer').
                    // \Component::btnUpdate(route('all-ticket-edit', $data->id), 'Ubah Ticket '. $data->name);
                    // \Component::btnDelete(route('all-ticket-destroy', $data->id), 'Hapus Ticket '. $data->name);
                    
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
                'users_has_packages.id as user_has_package_id'
            ])
            ->get();
            

        return view('cms.ticket.allticket.create', compact ('packages'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
    	// 	'name' => 'required|string|max:255',
        //     'speed' => 'required|string|max:15',
        // ]);

        $data = DB::table('users_has_packages')
        ->whereIn('user_id', auth()->user()->id)
        ->select('id');

        $request ['users_has_packages_id'] = $data->id;
        $request ['ticket_number'] = 1000;
        $request ['status'] = 1000;
        
        vardump ($request);
        Ticket::create($request->only(
            'users_has_packages_id',
            'subject', 
            'description',
            'priority',
            'attachment',
            'status',
            'ticket_number'
        ));

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
