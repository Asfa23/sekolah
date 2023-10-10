<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use Illuminate\Http\Request;

class PembayaranSiswaController extends Controller
{
    //
    public function submitPembayaran(Request $request)
    {
    try {
        // Ambil data input dari pengguna
        $idSiswa = $request->input('ID_SISWA');
        $jumlahPembayaran = $request->input('JUMLAH_PEMBAYARAN');
        $kategori = $request->input('KATEGORI');
        $tanggalPembayaran = $request->input('TANGGAL_PEMBAYARAN');

        if ($jumlahPembayaran < 0) {
            return "Jumlah pembayaran tidak boleh negatif.";
        }

        $pembayaran = new Pembayaran_Siswa();
        $pembayaran->ID_SISWA = $idSiswa;
        $pembayaran->JUMLAH_PEMBAYARAN = $jumlahPembayaran;
        $pembayaran->KATEGORI = $kategori;
        $pembayaran->TANGGAL_PEMBAYARAN = $tanggalPembayaran;
        $pembayaran->save();

        // Beri respons berhasil kepada pengguna
        return response()->json(['success' => 'Pemesanan berhasil disimpan.']);
    }
    }
    public function viewPembayaran(Request $request)
    {
        return view('showForm');
    }
}
