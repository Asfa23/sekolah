<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use App\Models\Pengeluaran_Sekolah;
use App\Models\FactTransaksi;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getChartData($year)
    {
        $labels = [];
        $totalPemasukan = [];
        $totalPengeluaran = [];
        $sisa = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date("F", mktime(0, 0, 0, $month, 1));

            // Pembayaran Siswa
            $totalPemasukan[] = Pembayaran_Siswa::whereYear('TANGGAL_PEMBAYARAN', $year)
                ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                ->sum('JUMLAH_PEMBAYARAN');

            // Pengeluaran Sekolah
            $totalPengeluaran[] = Pengeluaran_Sekolah::whereYear('TANGGAL_PENGELUARAN', $year)
                ->whereMonth('TANGGAL_PENGELUARAN', $month)
                ->sum('JUMLAH_PENGELUARAN');

            $sisa[] = $totalPemasukan[$month - 1] - $totalPengeluaran[$month - 1];
        }

        return response()->json([
            'labels' => $labels,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'sisa' => $sisa,
        ]);
    }
    public function getChartData2($year)
    {
        // Data for doughnut chart (pemasukan per kategori)
        $kategoriLabels = ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya'];
        $totalPemasukanPerkategori = [];
        $colorsPemasukanPerkategori = ['#FF6384', '#36A2EB', '#FFCE56'];

        // Initialize totalPemasukanPerkategori array
        foreach ($kategoriLabels as $kategori) {
            $totalPemasukanPerkategori[$kategori] = 0;
        }

        // Iterate through each month
        for ($month = 1; $month <= 12; $month++) {
            // Calculate total pemasukan for each category for the current month
            foreach ($kategoriLabels as $kategori) {
                $totalPemasukanPerkategori[$kategori] += Pembayaran_Siswa::whereYear('TANGGAL_PEMBAYARAN', $year)
                    ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                    ->where('KATEGORI', $kategori)
                    ->sum('JUMLAH_PEMBAYARAN');
            }
        }

        // Convert the associative array to an indexed array
        $indexedData = [
            'labels' => $kategoriLabels,
            'totalPemasukanPerkategori' => array_values($totalPemasukanPerkategori),
            'colors' => $colorsPemasukanPerkategori,
        ];

        return response()->json($indexedData);
    }

    
    public function getChartData3($year)
    {
        $kategoriLabelsPengeluaran = ['Inventaris', 'Maintenance', 'Gaji Guru & Staff', 'Program sekolah', 'Pengeluaran Lainnya'];
        $totalPengeluaranPerkategori = [];
        $colorsPengeluaranPerkategori = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];
    
        // Initialize totalPengeluaranPerkategori array
        foreach ($kategoriLabelsPengeluaran as $kategori) {
            $totalPengeluaranPerkategori[$kategori] = 0; // Menginisialisasi total pengeluaran ke 0
        }
    
        // Iterate through each month
        for ($month = 1; $month <= 12; $month++) {
            // Calculate total pengeluaran for each category for the current month
            foreach ($kategoriLabelsPengeluaran as $kategori) {
                $totalPengeluaranPerkategori[$kategori] += Pengeluaran_Sekolah::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $month)
                    ->where('KATEGORI', $kategori)
                    ->sum('JUMLAH_PENGELUARAN');
            }
        }
    
        // Convert the associative array to a flat array of total pengeluaran
        $totalPengeluaran = array_values($totalPengeluaranPerkategori);
    
        return response()->json([
            'labels' => $kategoriLabelsPengeluaran,
            'totalPengeluaranPerkategori' => [$totalPengeluaran], // Menggabungkan total pengeluaran menjadi satu array
            'colors' => $colorsPengeluaranPerkategori,
        ]);
    }    
}
