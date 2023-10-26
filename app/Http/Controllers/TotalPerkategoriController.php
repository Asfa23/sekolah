<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TotalPengeluaran;
use App\Models\pengeluaran_sekolah;
use App\Models\pembayaran_siswa;

class TotalPerkategoriController extends Controller
{
    // ======================================================================== MONEY REPORT
    public function calculateTotals()
    {
        $pembayaranSiswaTotals = pembayaran_siswa::select('KATEGORI')
            ->selectRaw('COALESCE(SUM(JUMLAH_PEMBAYARAN), 0) as TOTAL_PERKATEGORI')
            ->where('STATUS', 1)
            ->groupBy('KATEGORI')
            ->get();
    
        $pengeluaranSekolahTotals = pengeluaran_sekolah::select('KATEGORI')
            ->selectRaw('COALESCE(SUM(JUMLAH_PENGELUARAN), 0) as TOTAL_PERKATEGORI')
            ->groupBy('KATEGORI')
            ->get();
    
        $totals = $pembayaranSiswaTotals->concat($pengeluaranSekolahTotals);
    
        TotalPengeluaran::truncate();
        TotalPengeluaran::insert($totals->toArray());
    
        return redirect('/money_report');
    }    

}

