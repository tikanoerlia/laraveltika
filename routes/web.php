<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('home', [TransaksiController::class, 'index'])->name('home')->middleware('auth');

Route::get('barang', [TransaksiController::class, 'barang'])->name('barang');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::resource('/barang', \App\Http\Controllers\BarangController::class);

Route::delete('/barang/{id}', 'BarangController@destroy')->name('barang.destroy');


Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'proses_register'])->name('proses_register');

Route::resource('/transaksi', \App\Http\Controllers\TransaksiController::class);
Route::get('/nota/{id}', [TransaksiController::class, 'notaTransaksi'])->name('nota');