<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Temporary */
Route::get('/', 'Web\CustomerController@index')->name('customer-index');

Route::get('/asd', function () {
    return view('_layout.app');
});

Route::get('/dashboard', 'Web\DashboardController@index')->name('dashboard-index');

Route::prefix('transaction')->group(function () {

    Route::prefix('all-transaction')->group(function () {//==
        Route::get('/', 'Web\AllTransactionController@index')->name('all-transaction-index');
        Route::get('/datatables', 'Web\AllTransactionController@datatables')->name('all-transaction-datatables');
        Route::get('/create', 'Web\AllTransactionController@create')->name('all-transaction-create');
        Route::post('/store', 'Web\AllTransactionController@store')->name('all-transaction-store');
        Route::get('/edit/{id}', 'Web\AllTransactionController@edit')->name('all-transaction-edit');
        Route::post('/update/{id}', 'Web\AllTransactionController@update')->name('all-transaction-update');
        Route::delete('/destroy/{id}', 'Web\AllTransactionController@destroy')->name('all-transaction-destroy');
    });

    Route::prefix('unpaid')->group(function () {//==
        Route::get('/', 'Web\UnpaidController@index')->name('unpaid-index');
        Route::get('/datatables', 'Web\UnpaidController@datatables')->name('unpaid-datatables');              
    });

    Route::prefix('payments')->group(function () {//==
        Route::get('/', 'Web\PaymentsController@index')->name('payments-index');
        Route::get('/datatables', 'Web\PaymentsController@datatables')->name('payments-datatables');
        Route::get('/create', 'Web\PaymentsController@create')->name('payments-create');
        Route::post('/store', 'Web\PaymentsController@store')->name('payments-store');
        Route::get('/edit/{id}', 'Web\PaymentsController@edit')->name('payments-edit');
        Route::post('/update/{id}', 'Web\PaymentsController@update')->name('payments-update');
        Route::delete('/destroy/{id}', 'Web\PaymentsController@destroy')->name('payments-destroy'); //only admin
    });
   
});

Route::prefix('users')->group(function () {

    Route::prefix('customers')->group(function () {
        Route::get('/', 'Web\CustomerController@index')->name('customer-index');
        Route::get('/datatables', 'Web\CustomerController@datatables')->name('customer-datatables');
        Route::get('/create', 'Web\CustomerController@create')->name('customer-create');
        Route::post('/store', 'Web\CustomerController@store')->name('customer-store');
        Route::get('/edit/{id}', 'Web\CustomerController@edit')->name('customer-edit');
        Route::post('/update/{id}', 'Web\CustomerController@update')->name('customer-update');
        Route::delete('/destroy/{id}', 'Web\CustomerController@destroy')->name('customer-destroy'); 
    });

    Route::prefix('billing')->group(function () {
        Route::get('/', 'Web\BillingController@index')->name('billing-index');
        Route::get('/datatables', 'Web\BillingController@datatables')->name('billing-datatables');
        Route::get('/create', 'Web\BillingController@create')->name('billing-create');
        Route::post('/store', 'Web\BillingController@store')->name('billing-store');
        Route::get('/edit/{id}', 'Web\BillingController@edit')->name('billing-edit');
        Route::post('/update/{id}', 'Web\BillingController@update')->name('billing-update');
        Route::delete('/destroy/{id}', 'Web\BillingController@destroy')->name('billing-destroy'); 
    });

});

Route::prefix('packages')->group(function () {

    Route::prefix('list-package')->group(function () {
        Route::get('/', 'Web\ListPackageController@index')->name('list-package-index');
        Route::get('/datatables', 'Web\ListPackageController@datatables')->name('list-package-datatables');
        Route::get('/create', 'Web\ListPackageController@create')->name('list-package-create');
        Route::post('/store', 'Web\ListPackageController@store')->name('list-package-store');
        Route::get('/edit/{id}', 'Web\ListPackageController@edit')->name('list-package-edit');
        Route::post('/update/{id}', 'Web\ListPackageController@update')->name('list-package-update');
        Route::delete('/destroy/{id}', 'Web\ListPackageController@destroy')->name('list-package-destroy');  //only admin
    });

    Route::prefix('package-track')->group(function () {
        Route::get('/', 'Web\PackageTrackController@index')->name('package-track-index');
        Route::get('/datatables', 'Web\PackageTrackController@datatables')->name('package-track-datatables');
        Route::get('/edit/{id}', 'Web\PackageTrackController@edit')->name('package-track-edit');
        Route::post('/update/{id}', 'Web\PackageTrackController@update')->name('package-track-update');
    });

});

Route::prefix('ticket')->group(function () {

    Route::prefix('all-ticket')->group(function () {
        Route::get('/', 'Web\AllTicketController@index')->name('all-ticket-index');
        Route::get('/datatables', 'Web\AllTicketController@datatables')->name('all-ticket-datatables');       
        Route::delete('/destroy/{id}', 'Web\AllTicketController@destroy')->name('all-ticket-destroy');  //only admin
    });

    Route::prefix('create-ticket')->group(function () {
        Route::get('/', 'Web\CreateTicketController@index')->name('create-ticket-index');
        Route::get('/datatables', 'Web\CreateTicketController@datatables')->name('create-ticket-datatables');
        Route::get('/create', 'Web\CreateTicketController@create')->name('create-ticket-create');
        Route::post('/store', 'Web\CreateTicketController@store')->name('create-ticket-store');      
    });

    Route::prefix('unsolved-ticket')->group(function () {
        Route::get('/', 'Web\UnsolvedTicketController@index')->name('unsolved-ticket-index');
        Route::get('/datatables', 'Web\UnsolvedTicketController@datatables')->name('unsolved-ticket-datatables');        
        Route::get('/create', 'Web\UnsolvedTicketController@create')->name('unsolved-ticket-create');
        Route::post('/store', 'Web\UnsolvedTicketController@store')->name('unsolved-ticket-store');      
    });

});

Route::prefix('review')->group(function () {
    Route::get('/all-review', 'Web\AllReviewController@index')->name('review-index');
    Route::get('/datatables', 'Web\AllReviewController@datatables')->name('review-datatables');
    Route::get('/create', 'Web\AllReviewController@create')->name('review-create');
    Route::post('/store', 'Web\AllReviewController@store')->name('review-store');    
    Route::delete('/destroy/{id}', 'Web\AllReviewController@destroy')->name('review-destroy');  //only admin
});

//Akhir Routing







Route::prefix('paket')->group(function () {
    Route::get('/', 'Base\PaketController@index')->name('paket-index');
    //Route::post('/status-changes', 'Base\PaketController@StatusChanges')->name('setting-group-status');
    Route::get('/datatables', 'Base\PaketController@datatables');
    Route::get('/create', 'Base\PaketController@formCreate')->name('paket-create');
    Route::post('/store', 'Base\PaketController@store')->name('paket-store');
    Route::get('/edit/{id}', 'Base\PaketController@formEdit')->name('paket-edit');
    Route::post('/update/{id}', 'Base\PaketController@update')->name('paket-update');
});

Route::prefix('tiket')->group(function () {
    Route::get('/', 'Base\TiketController@index')->name('tiket-index');
    //Route::post('/status-changes', 'Base\PaketController@StatusChanges')->name('setting-group-status');
    //Route::get('/datatables', 'Base\PaketController@datatables');
    //Route::get('/create', 'Base\PaketController@formCreate')->name('paket-create');
    //Route::post('/store', 'Base\PaketController@store')->name('paket-store');
    //Route::get('/edit/{id}', 'Base\PaketController@formEdit')->name('paket-edit');
    //Route::post('/update/{id}', 'Base\PaketController@update')->name('paket-update');
});


