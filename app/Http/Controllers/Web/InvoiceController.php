<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth, Redirect;
use PDF;
use App\User, App\Router, App\UserHasPackage, App\Role, App\Package, App\Transaction, App\TransactionHasModified;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the invoice after payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $arrResponse = [
            'transactions.id as id',
            'users.name',
            'users.email',
            'users.contact_person',
            'transactions.paid',
            'packages.name as package_name',
            'transactions.price', 
            'expired_date',
            'transactions.updated_at',
            'transactions.payment_date',
            'transactions.expired_date',
            'transactions.type_payment',
            'transactions.status',
            'transactions.file'
        ];

        $data = DB::table('transactions')
      
        ->join('users_has_packages','transactions.users_has_packages_id','users_has_packages.id')
        ->join('packages','users_has_packages.package_id','packages.id')
        ->join('users','users_has_packages.user_id','users.id')
        ->select($arrResponse)
        ->where('transactions.id', $id)->first();

   
        $pdf = PDF::loadView('cms.transactions.invoice.print', ['data' => $data]);
        return $pdf->stream();
        // return $pdf->stream("invoice.pdf");

        // $output = $pdf->output();

        // return new Response($output, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' =>  'inline; filename="invoice.pdf"',
        // ]);



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
