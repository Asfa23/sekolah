<?php

use App\Http\Controllers\superAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use GuzzleHttp\Middleware;
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

Route::middleware(['guest'])->group(function (){
    // Login
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);    
});

Route::get('/home', function(){
    return redirect ('/dashboard');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/testing', [AdminController::class, 'index']);

    Route::get('/dashboard', [AdminController::class, 'about']);

    // Pembayaran
    Route::get('/dashboard/pembayaran', [PembayaranController::class, 'viewPembayaran']);
    Route::post('/dashboard/postPembayaran', [PembayaranController::class, 'submitPembayaran']);
    
    Route::get('/dashboard/lihat_pembayaran_siswa', [PembayaranController::class, 'lihatPembayaranSiswa']);

    // Buat Delete
    Route::get('/dashboard/edit_pembayaran/{id}', [PembayaranController::class, 'editPembayaran']);
    Route::post('/dashboard/update_pembayaran/{id}', [PembayaranController::class, 'updatePembayaran']);

    // Buat Delete
    Route::delete('/dashboard/delete_pembayaran/{id}', [PembayaranController::class, 'deletePembayaran']);
    Route::get('/dashboard/delete_confirmation/{id}', [PembayaranController::class, 'confirmDelete']);

    Route::get('/logout', [SesiController::class, 'logout']);

    // Pengeluaran    
    Route::get('/dashboard/pengeluaran', [PengeluaranController::class, 'viewPengeluaran']);
    Route::post('/dashboard/postPengeluaran', [PengeluaranController::class, 'submitPengeluaran']);

    Route::get('/dashboard/lihat_pengeluaran', [PengeluaranController::class, 'lihatPengeluaran']);
});




// // Buat masukin data inputan ke database 
// Route::get('/pembayaran', [PembayaranSiswaController::class, 'viewPembayaran']);
// Route::post('/postPembayaran', [PembayaranSiswaController::class, 'submitPembayaran']);

// // Buat ke tabel pembayaran_siswa dan dimunculin
// Route::get('/lihat_pembayaran_siswa', [PembayaranSiswaController::class, 'lihatPembayaranSiswa']);

// // Buat Edit datanya
// Route::get('/edit_pembayaran/{id}', [PembayaranSiswaController::class, 'editPembayaran']);
// Route::post('/update_pembayaran/{id}', [PembayaranSiswaController::class, 'updatePembayaran']);

// // Buat Delete
// Route::delete('/delete_pembayaran/{id}', [PembayaranSiswaController::class, 'deletePembayaran']);
// Route::get('/delete_confirmation/{id}', [PembayaranSiswaController::class, 'confirmDelete']);



