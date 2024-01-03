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

        if ($semester == 'Keseluruhan') {
            // Ambil data untuk 12 bulan
            for ($month = 1; $month <= 12; $month++) {
                $labels[] = date("F", mktime(0, 0, 0, $month, 1));

                $totalPemasukan[] = Pembayaran_Siswa::whereYear('TANGGAL_PEMBAYARAN', $year)
                    ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                    ->sum('JUMLAH_PEMBAYARAN');

                $totalPengeluaran[] = Pengeluaran_Sekolah::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $month)
                    ->sum('JUMLAH_PENGELUARAN');

                $sisa[] = $totalPemasukan[$month - 1] - $totalPengeluaran[$month - 1];
            }
        } else {
            // Ambil data sesuai semester
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

    foreach ($kategoriLabelsPengeluaran as $kategori) {
        $totalPengeluaranPerkategori[] = Pengeluaran_Sekolah::whereYear('TANGGAL_PENGELUARAN', $year)
            ->where('KATEGORI', $kategori)
            ->sum('JUMLAH_PENGELUARAN');
    }

    $colorsPengeluaranPerkategori = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

    $indexedData = [
        'labels' => $kategoriLabelsPengeluaran,
        'totalPengeluaranPerkategori' => $totalPengeluaranPerkategori,
        'colors' => $colorsPengeluaranPerkategori,
    ];

    return response()->json($indexedData);
}


}
