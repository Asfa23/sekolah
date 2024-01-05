<?php

namespace App\Http\Controllers;

use App\Models\FactPemasukan;
use App\Models\FactPengeluaran;

class ChartController extends Controller
{
    public function getChartData($year, $semester)
    {
        $labels = [];
        $totalPemasukan = [];
        $totalPengeluaran = [];
        $sisa = [];

        if ($semester == 'Keseluruhan') {
            for ($month = 1; $month <= 12; $month++) {
                $labels[] = date("F", mktime(0, 0, 0, $month, 1));

                $totalPemasukan[] = FactPemasukan::whereYear('TANGGAL_PEMBAYARAN', $year)
                    ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                    ->sum('JUMLAH_PEMBAYARAN');

                $totalPengeluaran[] = FactPengeluaran::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $month)
                    ->sum('JUMLAH_PENGELUARAN');

                $sisa[] = $totalPemasukan[$month - 1] - $totalPengeluaran[$month - 1];
            }
        } else {
            $startMonth = $semester === 'Ganjil' ? 1 : 7;
            $endMonth = $startMonth + 5;

            for ($month = $startMonth; $month <= $endMonth; $month++) {
                $labels[] = date("F", mktime(0, 0, 0, $month, 1));

                $totalPemasukan[] = FactPemasukan::whereYear('TANGGAL_PEMBAYARAN', $year)
                    ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                    ->sum('JUMLAH_PEMBAYARAN');

                $totalPengeluaran[] = FactPengeluaran::whereYear('TANGGAL_PENGELUARAN', $year)
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

        if ($semester == 'Keseluruhan') {
            for ($month = 1; $month <= 12; $month++) {
                foreach ($kategoriLabels as $kategori) {
                    $totalPemasukanPerkategori[$kategori] += FactPemasukan::whereYear('TANGGAL_PEMBAYARAN', $year)
                        ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                        ->where('KATEGORI', $kategori)
                        ->sum('JUMLAH_PEMBAYARAN');
                }
            }
        } else {
            if (in_array($semester, ['Ganjil', 'Genap'])) {
                $startMonth = $semester === 'Ganjil' ? 1 : 7;
                $endMonth = $startMonth + 5;

                for ($month = $startMonth; $month <= $endMonth; $month++) {
                    foreach ($kategoriLabels as $kategori) {
                        $totalPemasukanPerkategori[$kategori] += FactPemasukan::whereYear('TANGGAL_PEMBAYARAN', $year)
                            ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                            ->where('KATEGORI', $kategori)
                            ->sum('JUMLAH_PEMBAYARAN');
                    }
                }
            } else {
                $selectedMonth = intval($semester);
                foreach ($kategoriLabels as $kategori) {
                    $totalPemasukanPerkategori[$kategori] += FactPemasukan::whereYear('TANGGAL_PEMBAYARAN', $year)
                        ->whereMonth('TANGGAL_PEMBAYARAN', $selectedMonth)
                        ->where('KATEGORI', $kategori)
                        ->sum('JUMLAH_PEMBAYARAN');
                }
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
    $kategoriLabels = ['Inventaris', 'Maintenance', 'Gaji Guru & Staff', 'Program sekolah', 'Pengeluaran Lainnya'];
    $totalPengeluaranPerkategori = [];
    $colorsPengeluaranPerkategori = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

    foreach ($kategoriLabels as $kategori) {
        $totalPengeluaranPerkategori[$kategori] = 0;
    }

    if ($semester == 'Keseluruhan') {
        for ($month = 1; $month <= 12; $month++) {
            foreach ($kategoriLabels as $kategori) {
                $totalPengeluaranPerkategori[$kategori] += FactPengeluaran::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $month)
                    ->where('KATEGORI', $kategori)
                    ->sum('JUMLAH_PENGELUARAN');
            }
        }
    } else {
        if (in_array($semester, ['Ganjil', 'Genap'])) {
            $startMonth = $semester === 'Ganjil' ? 1 : 7;
            $endMonth = $startMonth + 5;

            for ($month = $startMonth; $month <= $endMonth; $month++) {
                foreach ($kategoriLabels as $kategori) {
                    $totalPengeluaranPerkategori[$kategori] += FactPengeluaran::whereYear('TANGGAL_PENGELUARAN', $year)
                        ->whereMonth('TANGGAL_PENGELUARAN', $month)
                        ->where('KATEGORI', $kategori)
                        ->sum('JUMLAH_PENGELUARAN');
                }
            }
        } else {
            $selectedMonth = intval($semester);
            foreach ($kategoriLabels as $kategori) {
                $totalPengeluaranPerkategori[$kategori] += FactPengeluaran::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $selectedMonth)
                    ->where('KATEGORI', $kategori)
                    ->sum('JUMLAH_PENGELUARAN');
            }
        }
    }

    $indexedData = [
        'labels' => $kategoriLabels,
        'totalPengeluaranPerkategori' => array_values($totalPengeluaranPerkategori),
        'colors' => $colorsPengeluaranPerkategori,
    ];

    return response()->json($indexedData);
}

    public function getChartDataSemester()
    {
        $labels = [];
        $totalPemasukan = [];
        $totalPengeluaran = [];
        $sisa = [];

        for ($year = 2020; $year <= 2024; $year++) {
            $labels[] = "Semester Ganjil " . $year;
            $totalPemasukanSemester = 0;
            $totalPengeluaranSemester = 0;

            for ($month = 1; $month <= 6; $month++) {
                $totalPemasukanSemester += FactPemasukan::whereYear('TANGGAL_PEMBAYARAN', $year)
                    ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                    ->sum('JUMLAH_PEMBAYARAN');

                $totalPengeluaranSemester += FactPengeluaran::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $month)
                    ->sum('JUMLAH_PENGELUARAN');
            }

            $totalPemasukan[] = $totalPemasukanSemester;
            $totalPengeluaran[] = $totalPengeluaranSemester;

            $sisa[] = $totalPemasukanSemester - $totalPengeluaranSemester;

            $labels[] = "Semester Genap " . $year;
            $totalPemasukanSemester = 0;
            $totalPengeluaranSemester = 0;

            for ($month = 7; $month <= 12; $month++) {
                $totalPemasukanSemester += FactPemasukan::whereYear('TANGGAL_PEMBAYARAN', $year)
                    ->whereMonth('TANGGAL_PEMBAYARAN', $month)
                    ->sum('JUMLAH_PEMBAYARAN');

                $totalPengeluaranSemester += FactPengeluaran::whereYear('TANGGAL_PENGELUARAN', $year)
                    ->whereMonth('TANGGAL_PENGELUARAN', $month)
                    ->sum('JUMLAH_PENGELUARAN');
            }

            $totalPemasukan[] = $totalPemasukanSemester;
            $totalPengeluaran[] = $totalPengeluaranSemester;

            $sisa[] = $totalPemasukanSemester - $totalPengeluaranSemester;
        }

        return response()->json([
            'labels' => $labels,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'sisa' => $sisa,
        ]);
    }

    public function getChartDataYear()
    {
        $labels = [];
        $totalPemasukan = [];
        $totalPengeluaran = [];
        $sisa = [];

        for ($year = 2020; $year <= 2024; $year++) {
            $labels[] = $year;

            $totalPemasukan[] = FactPemasukan::whereYear('TANGGAL_PEMBAYARAN', $year)->sum('JUMLAH_PEMBAYARAN');
            $totalPengeluaran[] = FactPengeluaran::whereYear('TANGGAL_PENGELUARAN', $year)->sum('JUMLAH_PENGELUARAN');
        }

        for ($i = 0; $i < count($labels); $i++) {
            $sisa[] = $totalPemasukan[$i] - $totalPengeluaran[$i];
        }

        return response()->json([
            'labels' => $labels,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'sisa' => $sisa,
        ]);
    }

}
