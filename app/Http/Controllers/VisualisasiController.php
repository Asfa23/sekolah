<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use App\Models\pengeluaran_sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisualisasiController extends Controller
{
    public function index()
    {
        $years = DB::table('pembayaran_siswa')
            ->select(DB::raw('YEAR(TANGGAL_PEMBAYARAN) as year'))
            ->distinct()
            ->get()
            ->pluck('year');

        return view('visualisasi', compact('years'));
    }

    // ==============================================================ini yg chartcontroller

    public function getChartData($year)
    {
        // Data for bar chart (total pemasukan, total pengeluaran, sisa)
        $labels = [];
        $totalPemasukan = [];
        $totalPengeluaran = [];
        $sisa = [];

        // Data for doughnut chart (pemasukan per kategori)
        $kategoriLabels = ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya'];
        $totalPemasukanPerkategori = [
            'Pembayaran Siswa' => [],
            'Bantuan Pemerintah' => [],
            'Pemasukan Lainnya' => [],
        ];
        $colorsPemasukanPerkategori = ['#FF6384', '#36A2EB', '#FFCE56'];

        // Data for doughnut chart (pengeluaran per kategori)
        $kategoriLabelsPengeluaran = ['Inventaris', 'Maintenance', 'Gaji Guru & Staff', 'Program sekolah', 'Pengeluaran Lainnya'];
        $totalPengeluaranPerkategori = [
            'Inventaris' => [],
            'Maintenance' => [],
            'Gaji Guru & Staff' => [],
            'Program sekolah' => [],
            'Pengeluaran Lainnya' => [],
        ];
        $colorsPengeluaranPerkategori = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

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

            // Data for doughnut chart (pemasukan per kategori)
            foreach ($kategoriLabels as $kategori) {
                $totalPemasukanPerkategori[$kategori][] = Pembayaran_Siswa::whereYear('TANGGAL_PEMBAYARAN', $year)
                    ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                    ->where('KATEGORI', $kategori)
                    ->sum('JUMLAH_PEMBAYARAN');
            }

            // Data for doughnut chart (pengeluaran per kategori)
            foreach ($kategoriLabelsPengeluaran as $kategori) {
                $totalPengeluaranPerkategori[$kategori][] = Pengeluaran_Sekolah::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $month)
                    ->where('KATEGORI', $kategori)
                    ->sum('JUMLAH_PENGELUARAN');
            }
        }

        return response()->json([
            'labels' => $labels,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'sisa' => $sisa,
            'data2' => [
                'labels' => $kategoriLabels,
                'totalPemasukanPerkategori' => array_values($totalPemasukanPerkategori),
                'colors' => $colorsPemasukanPerkategori,
            ],
            'data3' => [
                'labels' => $kategoriLabelsPengeluaran,
                'totalPengeluaranPerkategori' => array_values($totalPengeluaranPerkategori),
                'colors' => $colorsPengeluaranPerkategori,
            ],
        ]);
    }
    // ==============================================================ini END yg chartcontroller
}
