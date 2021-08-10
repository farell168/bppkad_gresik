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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
// Route::get('register', 'AuthController@showFormRegister')->name('register');
// Route::post('register', 'AuthController@register');
Route::group(['middleware' => 'auth'], function () {
    //data user
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('daftaruser', 'DataUserController@index')->name('daftaruser');
    Route::get('view_add_user', 'AddUserController@showFormRegister')->name('view_add_user');
    Route::get('view_edit_data_user/{user}', 'AddUserController@edit_user')->name('view_edit_data_user');
    Route::post('save_user', 'AddUserController@register')->name('save_user');
    Route::post('update_user', 'AddUserController@update_user')->name('update_user');
    Route::get('delete_user/{user}', 'AddUserController@delete_user')->name('delete_user');    
    
    //data pajak
    Route::get('daftarpajak', 'DataPajakController@index')->name('daftarpajak');
    Route::get('view_add_pajak', 'DataPajakController@showFormAddPajak')->name('view_add_pajak');
    Route::get('view_edit_pajak/{pajak}', 'DataPajakController@edit_pajak')->name('view_edit_pajak');
    Route::post('save_pajak', 'DataPajakController@add')->name('save_pajak');
    Route::post('update_pajak/{pajak}', 'DataPajakController@update_pajak')->name('update_pajak');
    Route::get('delete_pajak/{pajak}', 'DataPajakController@delete_pajak')->name('delete_pajak');    
    Route::post('import_pajak', 'DataPajakController@import')->name('import_pajak');    
    
    //data perhitungan
    Route::get('hasil', 'HasilController@index')->name('hasil');
    Route::get('proses_kmeans', 'HasilController@proses_kmeans')->name('proses_kmeans');
    
    //laporan
    Route::get('laporan', 'LaporanController@index')->name('laporan');
    Route::get('laporan_pajak', 'LaporanController@laporanPajak')->name('laporan_pajak');
    Route::get('laporan_kmeans_pajak', 'LaporanController@laporanKmeansPajak')->name('laporan_kmeans_pajak');
    Route::get('grafik', 'GrafikController@index')->name('grafik');
    Route::get('logout', 'AuthController@logout')->name('logout');
});
