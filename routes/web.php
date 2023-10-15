<?php

use App\Http\Controllers\superAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SesiController;
use GuzzleHttp\Middleware;
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

Route::middleware(['guest'])->group(function (){
    // Login
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);    
});

Route::get('/home', function(){
    return redirect ('/dashboard');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [AdminController::class, 'index']);

    // ====================== BUAT SISWA
    Route::get('/dashboard/siswa', [AdminController::class, 'siswa'])->middleware('userAkses:siswa');
    Route::get('/dashboard/siswa/pembayaran', [SiswaController::class, 'viewPembayaran'])->middleware('userAkses:siswa');
    Route::post('/dashboard/siswa/postPembayaran', [SiswaController::class, 'submitPembayaran'])->middleware('userAkses:siswa');    
    
    // ====================== BUAT GURU
    Route::get('/dashboard/guru', [AdminController::class, 'guru'])->middleware('userAkses:guru');
    
    
    // ====================== BUAT STAFF
    Route::get('/dashboard/staff', [AdminController::class, 'staff'])->middleware('userAkses:staff');
    
    // ====================== BUAT SUPER ADMIN
    Route::get('/dashboard/superAdmin', [AdminController::class, 'superAdmin'])->middleware('userAkses:superAdmin');
    Route::get('/dashboard/superAdmin/pembayaran', [superAdminController::class, 'viewPembayaran'])->middleware('userAkses:superAdmin');
    Route::post('/dashboard/superAdmin/postPembayaran', [superAdminController::class, 'submitPembayaran'])->middleware('userAkses:superAdmin');
    Route::get('/dashboard/superAdmin/lihat_pembayaran_siswa', [superAdminController::class, 'lihatPembayaranSiswa'])->middleware('userAkses:superAdmin');

        // Buat Delete
        Route::get('/dashboard/superAdmin/edit_pembayaran/{id}', [superAdminController::class, 'editPembayaran']);
        Route::post('/dashboard/superAdmin/update_pembayaran/{id}', [superAdminController::class, 'updatePembayaran']);

        // Buat Delete
        Route::delete('/dashboard/superAdmin/delete_pembayaran/{id}', [superAdminController::class, 'deletePembayaran']);
        Route::get('/dashboard/superAdmin/delete_confirmation/{id}', [superAdminController::class, 'confirmDelete']);

    Route::get('/logout', [SesiController::class, 'logout']);
    
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



