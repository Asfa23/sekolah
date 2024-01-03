<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use App\Models\Pengeluaran_Sekolah;
use App\Models\FactTransaksi;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function getChartData($year, $semester)
    {
        $labels = [];
        $totalPemasukan = [];
        $totalPengeluaran = [];
        $sisa = [];

        $startMonth = $semester === 'Ganjil' ? 1 : 7;
        $endMonth = $startMonth + 5;

        for ($month = $startMonth; $month <= $endMonth; $month++) {
            $labels[] = date("F", mktime(0, 0, 0, $month, 1));

            $totalPemasukan[] = Pembayaran_Siswa::whereYear('TANGGAL_PEMBAYARAN', $year)
                ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                ->sum('JUMLAH_PEMBAYARAN');

            $totalPengeluaran[] = Pengeluaran_Sekolah::whereYear('TANGGAL_PENGELUARAN', $year)
                ->whereMonth('TANGGAL_PENGELUARAN', $month)
                ->sum('JUMLAH_PENGELUARAN');

            $sisa[] = $totalPemasukan[$month - $startMonth] - $totalPengeluaran[$month - $startMonth];
        }

        return response()->json([
            'labels' => $labels,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'sisa' => $sisa,
        ]);
    }

    public function getChartData2($year, $semester)
    {
        $kategoriLabels = ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya'];
        $totalPemasukanPerkategori = [];
        $colorsPemasukanPerkategori = ['#FF6384', '#36A2EB', '#FFCE56'];

        foreach ($kategoriLabels as $kategori) {
            $totalPemasukanPerkategori[$kategori] = 0;
        }

        $startMonth = $semester === 'Ganjil' ? 1 : 7;
        $endMonth = $startMonth + 5;

        for ($month = $startMonth; $month <= $endMonth; $month++) {
            foreach ($kategoriLabels as $kategori) {
                $totalPemasukanPerkategori[$kategori] += Pembayaran_Siswa::whereYear('TANGGAL_PEMBAYARAN', $year)
                    ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                    ->where('KATEGORI', $kategori)
                    ->sum('JUMLAH_PEMBAYARAN');
            }
        }

        $indexedData = [
            'labels' => $kategoriLabels,
            'totalPemasukanPerkategori' => array_values($totalPemasukanPerkategori),
            'colors' => $colorsPemasukanPerkategori,
        ];

        return response()->json($indexedData);
    }

    public function getChartData3($year, $semester)
    {
        $kategoriLabelsPengeluaran = ['Inventaris', 'Maintenance', 'Gaji Guru & Staff', 'Program sekolah', 'Pengeluaran Lainnya'];
        $totalPengeluaranPerkategori = [];
        $colorsPengeluaranPerkategori = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

        foreach ($kategoriLabelsPengeluaran as $kategori) {
            $totalPengeluaranPerkategori[$kategori] = 0;
        }

        $startMonth = $semester === 'Ganjil' ? 1 : 7;
        $endMonth = $startMonth + 5;

        for ($month = $startMonth; $month <= $endMonth; $month++) {
            foreach ($kategoriLabelsPengeluaran as $kategori) {
                $totalPengeluaranPerkategori[$kategori] += Pengeluaran_Sekolah::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $month)
                    ->where('KATEGORI', $kategori)
                    ->sum('JUMLAH_PENGELUARAN');
            }
        }

        $indexedData = [
            'labels' => $kategoriLabelsPengeluaran,
            'totalPengeluaranPerkategori' => [$totalPengeluaranPerkategori], // Menggabungkan total pengeluaran menjadi satu array
            'colors' => $colorsPengeluaranPerkategori,
        ];

        return response()->json($indexedData);
    }

}
