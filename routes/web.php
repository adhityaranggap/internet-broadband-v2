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

Route::get('/', function () {
    return view('cms.base.index');
});

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


