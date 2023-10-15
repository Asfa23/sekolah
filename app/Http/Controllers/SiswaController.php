<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use Illuminate\Http\Request;
use DB;

class SiswaController extends Controller
{
    public function submitPembayaran(Request $request)
    {
        try {
            $idSiswa = $request->input('ID_SISWA');
            $jumlahPembayaran = $request->input('JUMLAH_PEMBAYARAN');
            $kategori = $request->input('KATEGORI');
            $tanggalPembayaran = $request->input('TANGGAL_PEMBAYARAN');
    
            if ($jumlahPembayaran < 0) {
                return response()->json(['error' => 'Jumlah pembayaran tidak boleh negatif.']);
            }
         
            $today = now();
            if ($tanggalPembayaran > $today) {
                return redirect('/dashboard/siswa/pembayaran')->with('error', 'Tanggal pembayaran tidak boleh melebihi hari ini.');
            }
    
            $pembayaran = new Pembayaran_Siswa();
            $pembayaran->ID_SISWA = $idSiswa;
            $pembayaran->JUMLAH_PEMBAYARAN = $jumlahPembayaran;
            $pembayaran->KATEGORI = $kategori;
            $pembayaran->TANGGAL_PEMBAYARAN = $tanggalPembayaran;
            $pembayaran->save();
    
            $request->session()->flash('success', 'Pembayaran berhasil disimpan.');
    
            return redirect('/dashboard/siswa/pembayaran');
        } catch (\Exception $e) {

            $request->session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
    
            return redirect('/dashboard/siswa/pembayaran');
        }
    }

    // ======================================================================== PEMBAYARAN
    public function viewPembayaran(Request $request)
    {
        return view('siswa_pembayaran');
    }

}
