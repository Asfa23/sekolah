<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\superAdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\TotalPerkategoriController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Models\TotalPengeluaran;
use App\Http\Controllers\MoneyReportController;
use App\Http\Controllers\ChartController;

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

// ======================================================================== LOGIN USER
Route::middleware(['guest'])->group(function (){
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);    
});

// ======================================================================== HOME
Route::get('/home', function(){
    return redirect ('/dashboard');
});

// ======================================================================== AUTH USER
Route::middleware(['auth'])->group(function (){
    Route::get('/testing', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'about']);

     // ======================================================================== HISTORI SISWA
    Route::get('/dashboard/history_pembayaran', [SiswaController::class, 'viewHistory']);

     // ======================================================================== CREATE PEMBAYARAN - SISWA
    Route::get('/dashboard/pembayaran', [PembayaranController::class, 'viewPembayaran']);
    Route::post('/dashboard/postPembayaran', [PembayaranController::class, 'submitPembayaran']);
 
    // ======================================================================== VIEW DATA PEMBAYARAN
    Route::get('/dashboard/lihat_pembayaran_siswa', [PembayaranController::class, 'lihatPembayaranSiswa'])->name('lihat_pembayaran_siswa');
    Route::post('/dashboard/approve_pembayaran/{id}', [PembayaranController::class, 'approvePembayaran']);

    // ======================================================================== EDIT PEMBAYARAN
    Route::get('/dashboard/edit_pembayaran/{id}', [PembayaranController::class, 'editPembayaran']);
    Route::post('/dashboard/update_pembayaran/{id}', [PembayaranController::class, 'updatePembayaran']);

    // ======================================================================== DELETE PEMBAYARAN
    Route::get('/dashboard/delete_confirmation_pembayaran/{id}', [PembayaranController::class, 'confirmDeletePembayaran']);
    Route::delete('/dashboard/delete_pembayaran/{id}', [PembayaranController::class, 'deletePembayaran']);
    Route::post('/dashboard/reject_pembayaran/{id}', [PembayaranController::class, 'rejectPembayaran']);

    // ======================================================================== CREATE PENGELUARAN
    Route::get('/dashboard/pengeluaran', [PengeluaranController::class, 'viewPengeluaran']);
    Route::post('/dashboard/postPengeluaran', [PengeluaranController::class, 'submitPengeluaran']);

    // ======================================================================== VIEW DATA PENGELUARAN
    Route::get('/dashboard/lihat_pengeluaran', [PengeluaranController::class, 'lihatPengeluaran']);

    // ======================================================================== CREATE PENGELUARAN
    Route::get('/dashboard/edit_pengeluaran/{id}', [PengeluaranController::class, 'editPengeluaran']);
    Route::post('/dashboard/update_pengeluaran/{id}', [PengeluaranController::class, 'updatePengeluaran']);

    // ======================================================================== DELETE PENGELUARAN
    Route::get('/dashboard/delete_confirmation_pengeluaran/{id}', [PengeluaranController::class, 'confirmDeletePengeluaran']);
    Route::delete('/dashboard/delete_pengeluaran/{id}', [PengeluaranController::class, 'deletePengeluaran']);

    // MONEY REPORT
    Route::get('/calculate_totals', [TotalPerkategoriController::class, 'calculateTotals']);
    Route::get('/money_report', function () {
        $totals = TotalPengeluaran::all();
        return view('money_report', compact('totals'));
    });

    // Rute untuk AJAX chart data
    Route::get('/getChartData/{year}', [ChartController::class, 'getChartData']);

    // ======================================================================== MANAJEMEN USER
    Route::get('/manajemen_user', [ManajemenUserController::class, 'index'])->name('manajemen_user');

    // ======================================================================== EDIT USER
    Route::get('/dashboard/edit_user/{id}', [ManajemenUserController::class, 'edit'])->name('edit_user');
    Route::post('/dashboard/update_user/{id}', [ManajemenUserController::class, 'update'])->name('update_user');

    // ======================================================================== DELETE USER
    Route::get('/dashboard/delete_confirmation_user/{id}', [ManajemenUserController::class, 'showDeleteConfirmation'])->name('delete_confirmation_user');
    Route::delete('/dashboard/delete_user/{id}', [ManajemenUserController::class, 'delete'])->name('delete_user');

    // ======================================================================== CREATE USER
    Route::get('/dashboard/create_user', [ManajemenUserController::class, 'create'])->name('create_user');
    Route::post('/dashboard/store_user', [ManajemenUserController::class, 'store'])->name('store_user');

    // ======================================================================== CREATE PEMBAYARAN - STAFF & SUPERADMIN
    Route::get('/dashboard/create_pembayaran', [superAdminController::class, 'showForm']);
    Route::post('/dashboard/create_pembayaran', [superAdminController::class, 'submitPembayaran']);

    // ======================================================================== LOG EDIT & DELETE
    Route::get('/dashboard/log', [LogController::class, 'viewLog'])->name('log');

    // ======================================================================== LOGOUT
    Route::get('/logout', [SesiController::class, 'logout']);
});