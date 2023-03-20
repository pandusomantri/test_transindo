<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\c_Pendaftaran;
use App\Http\Controllers\c_Admin;







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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('pendaftar');
});

// Login
Route::get('/admin', [LoginController::class, 'admin']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);


// Pendaftaran
Route::post('/pendaftaran', [c_Pendaftaran::class, 'pendaftaran']);
Route::get('/pendaftaran/{id}', [c_Pendaftaran::class, 'pendaftaran_id']);
Route::get('/pendaftaran_cetak/{id}', [c_Pendaftaran::class, 'pendaftaran_cetak']);

//Admin
Route::get('/checkin', [c_Admin::class, 'checkin']);
Route::get('/checkin_update/{id}', [c_Admin::class, 'checkin_update']);
Route::get('/checkin_id/{id}', [c_Admin::class, 'checkin_id']);
Route::post('/checkin_ubah', [c_Admin::class, 'checkin_ubah']);
Route::get('/checkin_hapus/{id}', [c_Admin::class, 'checkin_hapus']);

