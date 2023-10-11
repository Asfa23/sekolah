<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PembayaranSiswaController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pembayaran', [PembayaranSiswaController::class, 'viewPembayaran']);
Route::post('/postPembayaran', [PembayaranSiswaController::class, 'submitPembayaran']);

Route::get('/lihat_pembayaran_siswa', [PembayaranSiswaController::class, 'lihatPembayaranSiswa']);



