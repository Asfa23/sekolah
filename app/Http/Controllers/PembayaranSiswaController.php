<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use Illuminate\Http\Request;
use DB;

class PembayaranSiswaController extends Controller
{
    public function submitPembayaran(Request $request)
    {
        try {
            // Ambil data input dari pengguna
            $idSiswa = $request->input('ID_SISWA');
            $jumlahPembayaran = $request->input('JUMLAH_PEMBAYARAN');
            $kategori = $request->input('KATEGORI');
            $tanggalPembayaran = $request->input('TANGGAL_PEMBAYARAN');

            if ($jumlahPembayaran < 0) {
                return response()->json(['error' => 'Jumlah pembayaran tidak boleh negatif.']);
            }

            $pembayaran = new Pembayaran_Siswa();
            $pembayaran->ID_SISWA = $idSiswa;
            $pembayaran->JUMLAH_PEMBAYARAN = $jumlahPembayaran;
            $pembayaran->KATEGORI = $kategori;
            $pembayaran->TANGGAL_PEMBAYARAN = $tanggalPembayaran;
            $pembayaran->save();

            // Beri respons berhasil kepada pengguna
            return response()->json(['success' => 'Pembayaran berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function viewPembayaran(Request $request)
    {
        return view('tampilan_pembayaran');
    }

    public function lihatPembayaranSiswa()
    {
        $pembayaranSiswa = DB::table('pembayaran_siswa')->get();

        return view('lihat_pembayaran_siswa', ['pembayaranSiswa' => $pembayaranSiswa]);
    }
    
}
