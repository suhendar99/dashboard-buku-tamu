<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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
// Route::get('pengunjung/chart','PengunjungController@chart');
// Route::post('/pengunjung/laporan','PengunjungController@laporan');
// Route::resource('/', 'PengunjungController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['prefix' => 'buku-tamu','middleware' => 'auth'], function () {
    Route::get('dashboard','DashboardController@index');
    Route::resource('pengunjungBackend', 'PengunjungController');
    Route::post('pegawai/update','PegawaiController@update');
    Route::resource('pegawai', 'PegawaiController');
    Route::get('setapp','SetappController@edit');
    Route::post('setapp/update','SetappController@update');
});
