<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TotalPengeluaran;
use App\Models\pengeluaran_sekolah;
use App\Models\pembayaran_siswa;

class TotalPerkategoriController extends Controller
{

    public function calculateTotals()
    {
        // Hitung total per kategori dari model pembayaran_siswa dengan STATUS 1
        $pembayaranSiswaTotals = pembayaran_siswa::select('KATEGORI')
            ->selectRaw('COALESCE(SUM(JUMLAH_PEMBAYARAN), 0) as TOTAL_PERKATEGORI')
            ->where('STATUS', 1)
            ->groupBy('KATEGORI')
            ->get();
    
        // Hitung total per kategori dari model pengeluaran_sekolah
        $pengeluaranSekolahTotals = pengeluaran_sekolah::select('KATEGORI')
            ->selectRaw('COALESCE(SUM(JUMLAH_PENGELUARAN), 0) as TOTAL_PERKATEGORI')
            ->groupBy('KATEGORI')
            ->get();
    
        // Gabungkan hasil dari kedua model
        $totals = $pembayaranSiswaTotals->concat($pengeluaranSekolahTotals);
    
        // Simpan hasil perhitungan ke dalam tabel total_pengeluaran
        TotalPengeluaran::truncate(); // Hapus data lama
        TotalPengeluaran::insert($totals->toArray());
    
        return redirect('/money_report');
    }    

}

