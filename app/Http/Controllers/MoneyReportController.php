<?php
namespace App\Http\Controllers;

use App\Models\TotalPengeluaran;
use App\Models\Pembayaran_Siswa;
use Illuminate\Http\Request;
use DB;

// class MoneyReportController extends Controller 
// {
   //  public function index()
     // {
        // Ambil data total pengeluaran
        // $totalPengeluaran = TotalPengeluaran::all();

        // Ambil data total pendapatan (Pembayaran Siswa dengan status 1)
        // $totalPendapatan = Pembayaran_Siswa::where('STATUS', 1)->sum('JUMLAH_PEMBAYARAN');

        // return view('money_report', compact('totalPengeluaran', 'totalPendapatan'));
    // }
// }