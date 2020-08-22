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

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['prefix' => 'buku-tamu','middleware' => 'is_admin'], function () {
    Route::resource('user', 'UserController');
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('aktivitas','DashboardController@store')->name('aktivitas.store');
    Route::get('user/edit','UserController@userupdate')->name('user.updated');
    Route::put('update_user/{id}','UserController@updateuser')->name('update.user');
    Route::get('pass/edit','UserController@passupdate')->name('pass.update');
    Route::put('update_pass/{id}','UserController@updatepass')->name('update.pass');
    Route::resource('log', 'LogController');
    Route::post('pengunjung/laporan','PengunjungController@laporan')->name('pengunjung.laporan');
    Route::get('pengunjung/antri','PengunjungController@antri')->name('antri');
    Route::resource('pengunjungBackend', 'PengunjungController');
    Route::post('pegawai/update','PegawaiController@update');
    Route::post('pegawai/laporan','PegawaiController@laporan');
    Route::resource('pegawai', 'PegawaiController');
    Route::get('setapp/{id}','SetappController@edit')->name('setapp.update');
    Route::post('setapp/update','SetappController@update');
    Route::get('setlap/{id}','SetlapController@edit')->name('setlap.update');
    Route::post('setlap/update','SetlapController@update');
});
