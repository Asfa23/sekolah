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

// Buat ke tabel pembayaran_siswa dan dimunculin
Route::get('/lihat_pembayaran_siswa', [PembayaranSiswaController::class, 'lihatPembayaranSiswa']);

// Buat Edit datanya
Route::get('/edit_pembayaran/{id}', [PembayaranSiswaController::class, 'editPembayaran']);
Route::post('/update_pembayaran/{id}', [PembayaranSiswaController::class, 'updatePembayaran']);

// Buat Delete
Route::delete('/delete_pembayaran/{id}', [PembayaranSiswaController::class, 'deletePembayaran']);
Route::get('/delete_confirmation/{id}', [PembayaranSiswaController::class, 'confirmDelete']);

// Buat login
Route::get('/login', [PembayaranSiswaController::class, 'viewLogin']);

// Buat About
Route::get('/about', [PembayaranSiswaController::class, 'viewAbout']);



