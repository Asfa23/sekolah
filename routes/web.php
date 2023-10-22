<?php

use App\Http\Controllers\superAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TotalPerkategoriController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Models\TotalPengeluaran;

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

    // ================Pembayaran================
    Route::get('/dashboard/pembayaran', [PembayaranController::class, 'viewPembayaran']);
    Route::post('/dashboard/postPembayaran', [PembayaranController::class, 'submitPembayaran']);
    
    Route::get('/dashboard/lihat_pembayaran_siswa', [PembayaranController::class, 'lihatPembayaranSiswa']);
    Route::post('/dashboard/approve_pembayaran/{id}', [PembayaranController::class, 'approvePembayaran']);

    // Buat edit PEMBAYARAN
    Route::get('/dashboard/edit_pembayaran/{id}', [PembayaranController::class, 'editPembayaran']);
    Route::post('/dashboard/update_pembayaran/{id}', [PembayaranController::class, 'updatePembayaran']);

    // Buat Delete PEMBAYARAN
    Route::delete('/dashboard/delete_pembayaran/{id}', [PembayaranController::class, 'deletePembayaran']);
    Route::get('/dashboard/delete_confirmation/{id}', [PembayaranController::class, 'confirmDeletePembayaran']);

    // ================Pengeluaran================
    Route::get('/dashboard/pengeluaran', [PengeluaranController::class, 'viewPengeluaran']);
    Route::post('/dashboard/postPengeluaran', [PengeluaranController::class, 'submitPengeluaran']);

    Route::get('/dashboard/lihat_pengeluaran', [PengeluaranController::class, 'lihatPengeluaran']);

    // Buat edit PENGELUARAN
    Route::get('/dashboard/edit_pengeluaran/{id}', [PengeluaranController::class, 'editPengeluaran']);
    Route::post('/dashboard/update_pengeluaran/{id}', [PengeluaranController::class, 'updatePengeluaran']);

    // Buat Delete PENGELUARAN
    Route::delete('/dashboard/delete_pengeluaran/{id}', [PengeluaranController::class, 'deletePengeluaran']);
    Route::get('/dashboard/delete_confirmation/{id}', [PengeluaranController::class, 'confirmDeletePengeluaran']);

    Route::get('/calculate_totals', [TotalPerkategoriController::class, 'calculateTotals']);
    Route::get('/money_report', function () {
        $totals = TotalPengeluaran::all();
        return view('money_report', compact('totals'));
    });
    

    // Logout
    Route::get('/logout', [SesiController::class, 'logout']);
});