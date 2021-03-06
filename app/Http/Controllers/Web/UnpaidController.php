<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\Redirect;
use DataTables, Auth;
use App\Notifications\InvoicePaid;
use Illuminate\Notifications\Notifiable;
use App\User, App\Router, App\UserHasPackage, App\Role, App\Package, App\Transaction, App\TransactionHasModified;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use \RouterOS\Client;
use \RouterOS\Query;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
 
class UnpaidController extends Controller
{
    use Notifiable;
    use \Illuminate\Notifications\Notifiable;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.transactions.unpaid.index');
    }


    public function datatables()
    {       
        // $modified = DB::table('transaction_has_modified')
        // ->join('transactions', 'transaction_has_modified.transaction_id', 'transactions.id')
        // ->get();
        // return $modified;

            $arrSelect = [
                'users.username as name',
                'transactions.expired_date as expired_date',
                'packages.name as package_name',
                'transactions.price as price',
                'transactions.id as id',
                'transactions.status as status',
                'users.role_id',
                // 'trasanction_has_modified.transaction_id as transaction_modified'
            ];
            if (Auth::check() && auth()->user()->role_id == Role::ROLE_CUSTOMER){
            $data = DB::table('users')
            ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
            ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
            ->join('transactions', 'users_has_packages.id', '=', 'transactions.users_has_packages_id')
            // ->join('transaction_has_modified', 'transactions.id', 'transaction_has_modified.transaction_id')
            ->where('users_has_packages.user_id', auth()->user()->id)
            ->where('transactions.status', '!=' ,\EnumTransaksi::STATUS_LUNAS)
            ->whereBetween('transactions.expired_date', array(Carbon::now()->addYears(-1), Carbon::now()->addMonths(1)))
            ->orderBy('transactions.expired_date','desc')
            ->select($arrSelect)
            ->get();
 
            }else{
            $data = DB::table('users')
            ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
            ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
            ->join('transactions', 'users_has_packages.id', '=', 'transactions.users_has_packages_id')
            // ->join('transaction_has_modified', 'transactions.id', 'transaction_has_modified.transaction_id')
            ->whereBetween('transactions.expired_date', array(Carbon::now()->addYears(-1), Carbon::now()->addMonths(1)))
            ->where('transactions.status', '!=' , \EnumTransaksi::STATUS_LUNAS)

            ->orderBy('transactions.expired_date','desc')
            ->select($arrSelect)
            ->get();
            
            };
            
        return Datatables::of($data)  

        ->editColumn('id',
            function ($data){
                return $data->id;
        })     
        ->editColumn('name',
            function ($data){
                return $data->name;
        })     
               
        ->editColumn('package_name',
            function ($data){
                return $data->package_name;
        })   
     
        ->editColumn('expired_date',
            function ($data){
                return Carbon::parse($data->expired_date)->format('Y-m-d');
        })              
        ->editColumn('status',
            function ($data){
                return \EnumTransaksi::status($data->status);
        })              
              
        ->editColumn('action',
            function ($data){                                
            
                    return
                    \Component::btnRead(route('unpaid-detail', $data->id), 'Detail Transaction '. $data->name).
                    \Component::btnUpdate(route('unpaid-edit', $data->id), 'Ubah Transaction '. $data->name);
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
        $packages = Package::all();
        return view('cms.transactions.unpaid.create', compact('packages'));
    }

    public function NotificationWA($id)
    {
        $arrResponse = [
            'transactions.id as id',
            'transactions.paid',
            'transactions.price',
            'transactions.price as payment_billing', 
            'transactions.expired_date',
            'transactions.updated_at',
            'users.name',
            'users.contact_person',
            'users.address',
            'packages.name as package_name'
        ];

        $data = DB::table('transactions')
        ->join('users_has_packages','transactions.users_has_packages_id','users_has_packages.id')
        ->join('packages','users_has_packages.package_id','packages.id')
        ->join('users','users_has_packages.user_id','users.id')
        ->select($arrResponse)
        ->where('transactions.id', $id)->first();

        $contactPerson  = $data->contact_person;
        $address        = $data->address;
        $package_name   = $data->package_name;
        $price          = $data->price;
        $user           = $data->name;

        return Redirect::away('https://api.whatsapp.com/send?phone='.$contactPerson.'&text=Kepada%20Yth%20Bapak/Ibu:%20'.$user.',%0D%0AAlamat:%20'.$address.',%0D%0APaket:%20'.$package_name.',%0D%0ATotal%20Tagihan:%20Rp.%20'.$price.',%0D%0APembayaran%20mulai%20tanggal%201-5%20tiap%20bulannya,%20pembayaran%20bisa%20dilakukan%20via%20transfer%20bank%20ke%20BCA%206755070622%20a.n%20Adhitya%20Rangga%20Putra%20KCP%20Jatiasih%20(Rumah%20Internet%20Payment).%0D%0ATerimakasih%20atas%20pengertiannya.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package_id = $request['package'];
        $data = Package::select('price')->where('id', $package_id)->first();
        $maxPaid = $data->price;
        
        $sisa    = $data->price - $request->paid;
        
        $this->validate($request,[
            'users_has_packages_id'       => 'required|max:50',
            'expired_date'                => 'required|max:100',
            'paid'                        => 'required|numeric|max:'.$maxPaid,
        ]);


    //payment_proof
        if($request->type_payment === "Transfer"){
            $this->validate($request, [
                'payment_proof' =>  'mimes:jpeg,jpg,png,gif|required|max:8000'
            ]);
        }

        // $request['updated_at'] = now();        
        // $request['created_at'] = now();        
        $request['notes']      = '-';        
        $request['price']      = $data->price;
        if($sisa == 0){
            $request['status'] = \EnumTransaksi::STATUS_LUNAS;
        }else{
            $request['status'] = \EnumTransaksi::STATUS_BELUM_LUNAS;
        }
        
            //  Transaction::create($request->except('_token'));


            if($request->type_payment === "Transfer"){
                //payment_proof
                    if($request->file('payment_proof')){
                        $dir = 'payment_proof/';
                        $size = '360';
                        $format = 'file';
                        $image = $request->file('payment_proof');         
                        // $request['file'] = Storage::disk('minio')->put($image);
                        $request['file'] = \ImageUploadHelper::pushStorage($dir, $size, $format, $image);
                        
                    }
                    // TransactionHasModified::create([
                    //     'user_id'               => Auth::user()->id,
                    //     'transaction_id'        => $id,
                    //     'action'                => \EnumTransaksiHasModified::UPDATE
                    // ]);
                    // $request['transaction_has_modified_id'] = DB::getPDO()->lastInsertId();

                    Transaction::create($request->except('_token'));
                    // TransactionHasModified::create([
                    //     'user_id'               => Auth::user()->id,
                    //     'transaction_id'        => $id,
                    //     'action'                => \EnumTransaksiHasModified::UPDATE
                    // ]);
                    // $transaction->notify(new InvoicePaid($invoice));

                }else{
                   
                    // TransactionHasModified::create([
                    //     'user_id'               => Auth::user()->id,
                    //     'transaction_id'        => $id,
                    //     'action'                => \EnumTransaksiHasModified::UPDATE
                    // ]);
                    // $request['transaction_has_modified_id'] = DB::getPDO()->lastInsertId();
                    Transaction::create($request->except('_token','file'));
                    // $transaction->notify(new InvoicePaid($invoice));
                    // $transaction->notify(new InvoicePaid("Payment Received!"));


                    
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
        $arrResponse = [
            'transactions.id as id',
            'transactions.paid',
            'transactions.payment_date',
            'transactions.price as payment_billing', 
            'transactions.expired_date',
            'transactions.updated_at',
            'users.name',
            'users.contact_person',
            'packages.name as package_name'
        
        ];

        $data = DB::table('transactions')
        ->join('users_has_packages','transactions.users_has_packages_id','users_has_packages.id')
        ->join('packages','users_has_packages.package_id','packages.id')
        ->join('users','users_has_packages.user_id','users.id')
        ->select($arrResponse)
        ->where('transactions.id', $id)->first();
        
        
        return view('cms.transactions.unpaid.edit', compact ('data'));    }

    /**
     * `Detail` the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $arrResponse = [
            'transactions.id as id',
            'transactions.updated_at',
            'transactions.type_payment',
            'transactions.expired_date',
            'transactions.payment_date',
            'transactions.status',
            'transactions.price as payment_billing', 
            'transactions.paid',
            'transactions.file',
            'users.name',
            'users.contact_person',
            'packages.name as package_name'
           
        ];

        $data = DB::table('transactions')
      
        ->join('users_has_packages','transactions.users_has_packages_id','users_has_packages.id')
        ->join('packages','users_has_packages.package_id','packages.id')
        ->join('users','users_has_packages.user_id','users.id')
        ->select($arrResponse)
        ->where('transactions.id', $id)->first();
        
        // return response()->json($data);

        return view('cms.transactions.unpaid.detail', compact ('data'));
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
        $transaction = Transaction::where('id', $id)->first();
        $maxPaid = $transaction->price - $transaction->paid;
        $UserPay = $request->paid+$transaction->paid;
        
        $this->validate($request, [
            'paid' =>  'required|numeric|max:'.$maxPaid,

        ]);
    //payment_proof
        if($request->type_payment === "Transfer"){
            $this->validate($request, [
                'payment_proof' =>  'mimes:jpeg,jpg,png,gif|required|max:8000'
            ]);
        }
        $request['transaction_has_modified_id'] = 1;

        $request['updated_at'] = now();
        $request['paid'] = $UserPay;

        $arrResponse = [
            'users_has_packages.id as id',
            'transactions.expired_date',
            'transactions.payment_date',
            'transactions.fee',
            'transactions.status',
            'packages.price',
            'users.email',
        ];

       
        $transaction = DB::table('transactions')
        ->join('users_has_packages','transactions.users_has_packages_id','users_has_packages.id')
        ->join('users','users_has_packages.user_id','users.id')
        ->join('packages','users_has_packages.package_id','packages.id')
        ->select($arrResponse)
        ->where('transactions.id', $id)->first();

        $sisa = $transaction->price - $request->paid;

        if($sisa == 0){
            $request['status'] = \EnumTransaksi::STATUS_LUNAS;
        }else{
            $request['status'] = \EnumTransaksi::STATUS_BELUM_LUNAS;
        }
        
        

        if($transaction){

            if($transaction->status != \EnumTransaksi::STATUS_LUNAS){
                
                if($request->type_payment === "Transfer"){
                //payment_proof
                    if($request->file('payment_proof')){
                        $dir = 'payment_proof/';
                        $size = '360';
                        $format = 'file';
                        $image = $request->file('payment_proof');         
                        // $request['file'] = Storage::disk('minio')->put($image);
                        $request['file'] = \ImageUploadHelper::pushStorage($dir, $size, $format, $image);
                        
                    }
                    // TransactionHasModified::create([
                    //     'user_id'               => Auth::user()->id,
                    //     'transaction_id'        => $id,
                    //     'action'                => \EnumTransaksiHasModified::UPDATE
                    // ]);
                    // $request['transaction_has_modified_id'] = DB::getPDO()->lastInsertId();

                    Transaction::where('id', $id)->update($request->only('updated_at','payment_date','expired_date','transaction_has_modified_id','type_payment','notes', 'file', 'fee', 'status', 'paid'));
                    // TransactionHasModified::create([
                    //     'user_id'               => Auth::user()->id,
                    //     'transaction_id'        => $id,
                    //     'action'                => \EnumTransaksiHasModified::UPDATE
                    // ]);
                    // $transaction->notify(new InvoicePaid($invoice));
                    // if($request->status === \EnumTransaksi::STATUS_LUNAS){
           
                    //     Transaction::create([
                    //         'users_has_packages_id'         => $transaction->id,
                    //         'transaction_has_modified_id'   => 1,
                    //         'notes'                         => '-',
                    //         'expired_date'                  => Carbon::parse($transaction->expired_date)->addMonths(1),
                    //         'status'                        => \EnumTransaksi::STATUS_BELUM_BAYAR,
                    //         'price'                         => $transaction->price,
                    //         'fee'                           => $transaction->fee,
                    //         'paid'                          => $transaction->fee,
                    //         'created_at'                    => now(),                   
                    //     ]);
                    //     // TransactionHasModified::create([
                    //     //     'user_id'               => Auth::user()->id,
                    //     //     'transaction_id'        => DB::getPdo()->lastInsertId(),
                    //     //     'action'                => \EnumTransaksiHasModified::CREATE
                    //     // ]);
                    // }
                }else{
                   
                    // TransactionHasModified::create([
                    //     'user_id'               => Auth::user()->id,
                    //     'transaction_id'        => $id,
                    //     'action'                => \EnumTransaksiHasModified::UPDATE
                    // ]);
                    // $request['transaction_has_modified_id'] = DB::getPDO()->lastInsertId();
                    Transaction::where('id', $id)->update($request->only('updated_at','payment_date','expired_date','transaction_has_modified_id','notes','type_payment', 'fee', 'status', 'paid'));
                    // $transaction->notify(new InvoicePaid($invoice));
                    // $transaction->notify(new InvoicePaid("Payment Received!"));

                    // if($request->status === \EnumTransaksi::STATUS_LUNAS){
           
                    //     Transaction::create([
                    //         'users_has_packages_id'         => $transaction->id,
                    //         'transaction_has_modified_id'   => 1,
                    //         'notes'                         => '-',
                    //         'expired_date'                  => Carbon::parse($transaction->expired_date)->addMonths(1),
                    //         'status'                        => \EnumTransaksi::STATUS_BELUM_BAYAR,
                    //         'price'                         => $transaction->price,
                    //         'fee'                           => $transaction->fee,
                    //         'paid'                          => $transaction->fee,
                    //         'created_at'                    => now(),                   
                    //     ]);
                    //     // TransactionHasModified::create([
                    //     //     'user_id'               => Auth::user()->id,
                    //     //     'transaction_id'        => DB::getPdo()->lastInsertId(),
                    //     //     'action'                => \EnumTransaksiHasModified::CREATE
                    //     // ]);
                    // }
                    
                }
                if($request->status === \EnumTransaksi::STATUS_LUNAS){
           
                    Transaction::create([
                        'users_has_packages_id'         => $transaction->id,
                        'transaction_has_modified_id'   => 1,
                        'notes'                         => '-',
                        'expired_date'                  => Carbon::parse($transaction->expired_date)->addMonths(1),
                        'status'                        => \EnumTransaksi::STATUS_BELUM_BAYAR,
                        'price'                         => $transaction->price,
                        'fee'                           => $transaction->fee,
                        'paid'                          => $transaction->fee,
                        'created_at'                    => now(),                   
                    ]);
                };        
                
            }
          
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sync()
    {
        
       
        $arrSelect = [
            'transactions.id as id',
            'users.username as name',
            'transactions.expired_date as expired_date',
            'packages.name as package_name',
            'transactions.price as price',
            'transactions.status as status',
            'users.role_id'
        ];
        $users = DB::table('users')
        ->join('users_has_packages', 'users.id', '=', 'users_has_packages.user_id')
        ->join('packages', 'users_has_packages.package_id', '=', 'packages.id')
        ->join('transactions', 'users_has_packages.id', '=', 'transactions.users_has_packages_id')
        ->orderBy('transactions.expired_date','desc')
        ->select($arrSelect)
        ->get();

        $results = array();
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
            foreach ($users as $key => $user)
            {
    
                if($user->status == \EnumTransaksi::STATUS_TENGGANG )
                {
                    // Get list of all available profiles with name Block
                    $query = new Query('/ppp/secret/print');
                    $query->where('name', $user->name);
                    $secrets = $client->query($query)->read();
    
                    // Parse secrets and set password
                    foreach ($secrets as $secret) {
    
                        // Change profile
                        $query = (new Query('/ppp/secret/set'))
                            ->equal('.id', $secret['.id'])
                            ->equal('profile', 'Block');
    
                        // Update query ordinary have no return
                        $client->query($query)->read();
                    }
                } else {
                    $query = new Query('/ppp/secret/print');
                    $query->where('name', $user->name);
                    $secrets = $client->query($query)->read();
    
                    // Parse secrets and set password
                    foreach ($secrets as $secret) {
    
                        // Change password
                        $query = (new Query('/ppp/secret/set'))
                            ->equal('.id', $secret['.id'])
                            ->equal('profile', $user->package_name);
    
                        // Update query ordinary have no return
                        $client->query($query)->read();
                     };
                 }
                // TransactionHasModified::create([
                //     'user_id'               => Auth::user()->id,
                //     'transaction_id'        => $id,
                //     'action'                => \EnumTransaksiHasModified::SYNC_DATA
                // ]);
            }    
        }
       
        return back();
    }
    public function destroy($id)
    {
    // if (Auth::check() && auth()->user()->role_id != Role::ROLE_CUSTOMER){
          // menghapus data trx berdasarkan id yang dipilih
    $trx = Transaction::where('id', $id)->first();

    if (is_null($trx)){
        return 'Tidak ditemukan';
    }
    //check status payment
    elseif($trx->status == \EnumTransaksi::STATUS_LUNAS){
        $dt = Carbon::now()->toDateString();
        //if date more than now set to terminated
            if($trx->expired_date < $dt){
                Transaction::where('id', $id)->update([
                    'status' => \EnumTransaksi::STATUS_TENGGANG,
                    'paid' => 0
                    ]);
                }
             
            elseif($trx->expired_date >= $dt){
                Transaction::where('id', $id)->update([
                    'status' => \EnumTransaksi::STATUS_BELUM_LUNAS,
                    'paid' => 0
                    ]);
                }
        // TransactionHasModified::create([
        //     'user_id'               => Auth::user()->id,
        //     'transaction_id'        => $id,
        //     'action'                => \EnumTransaksiHasModified::SYNC_DATA
        // ]);

    }else{
        $trx->delete();
       
    // }
    }
    }
}
