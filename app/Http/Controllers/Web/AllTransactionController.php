<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use DataTables;
use App\User, App\UserHasPackage, App\Package, App\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
 
class AllTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.transactions.alltransaction.index');
    }


    public function datatables()
    {       
    
        $arrSelect = [
            'users.name as name',
            'transactions.expired_date as expired_date',
            'packages.name as package_name',
            'transactions.price as price',
            'transactions.id as id',
            'transactions.status as status',
        ];
        // $data = transaction::all();
        $data = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->join('transactions', 'users_has_packages.id', '=', 'transactions.user_has_package_Id')
        ->orderBy('transactions.created_at','desc')
        ->select($arrSelect)
        ->get();
 
        return Datatables::of($data)  
        ->editColumn('name',
            function ($data){
                return $data->name;
        })     
        ->editColumn('month_date',
            function ($data){
                return date('M Y', strtotime($data->expired_date));
        })                
        ->editColumn('package_name',
            function ($data){
                return $data->package_name;
        })   
        ->editColumn('price',
            function ($data){
                return $data->price;
        })   
        ->editColumn('expired_date',
            function ($data){
                return $data->expired_date;
        })              
        ->editColumn('status',
            function ($data){
                return \EnumTransaksi::status($data->status);
        })              
              
        ->editColumn('action',
            function ($data){                                
            
                    return
                    //\Component::btnRead('#', 'Detail Customer').
                    \Component::btnUpdate(route('all-transaction-edit', $data->id), 'Ubah Transaction '. $data->name);
                    // \Component::btnDelete(route('all-transaction-destroy', $data->id), 'Hapus Package '. $data->name);
                    
        })
        ->addIndexColumn()
        ->rawColumns(['status', 'action']) 
        ->make(true);          
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.transactions.alltransaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file'                    =>  'required|mimes:jpeg,bmp,png|max:10000',
            'notes'                     =>  'nullable',
        ]);
        



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
        $data = DB::table('transactions')
        ->join('users_has_packages','transactions.user_has_package_id','users_has_packages.id')
        ->join('packages','users_has_packages.package_id','packages.id')
        ->join('users','users_has_packages.user_id','users.id')
        ->select('transactions.id as id', 'users.name', 'users.contact_person', 'packages.name as package_name', 'transactions.price as payment_billing', 'expired_date' )
        ->where('transactions.id', $id)->first();
        
        
        return view('cms.transactions.alltransaction.edit', compact ('data'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->type_payment === "Transfer"){
            $this->validate($request, [
                'file' =>  'mimes:jpeg,jpg,png,gif|required|max:8000'
            ]);
        }
 
        $request['updated_at'] = now();
        $request['status'] = \EnumTransaksi::STATUS_LUNAS;


        $arrResponse = [
            'users_has_packages.id as id',
            'transactions.expired_date',
            'transactions.fee',
            'transactions.status',
            'packages.price',
        ];
        
        $transaction = DB::table('transactions')
        ->join('users_has_packages','transactions.user_has_package_id','users_has_packages.id')
        ->join('packages','users_has_packages.package_id','packages.id')
        ->select($arrResponse)
        ->where('transactions.id', $id)->first();
        

        if($transaction){

            if($transaction->status != \EnumTransaksi::STATUS_LUNAS){
                if($request->type_payment === "Transfer"){
                    if($request->file('file')){
                        $dir = 'payment_proof/';
                        $size = '360';
                        $format = 'payment_proof';
                        $image = $request->file('file');         
                        $request['payment_proof'] = \ImageUploadHelper::pushStorage($dir, $size, $format, $image);
                    }
    
                    Transaction::where('id', $id)->update($request->only('updated_at', 'payment_proof', 'fee', 'status'));
    
                }else{
                    Transaction::where('id', $id)->update($request->only('updated_at', 'fee', 'status'));
                }    
                
                Transaction::create([
                    'user_has_package_id'   =>  $transaction->id,
                    'transaction_has_modified_id'   => 1,
                    'notes'                 => '-',
                    'expired_date'          => Carbon::parse($transaction->expired_date)->addMonths(1),
                    'status'                => \EnumTransaksi::STATUS_BELUM_BAYAR,
                    'price'                 =>  $transaction->price,
                    'fee'                   =>  $transaction->fee,
                    'created_at'            =>  now(),                   
                ]);
            }
          
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
        //
    }
}
