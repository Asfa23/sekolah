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

    // ======================================================================== EDIT PEMBAYARAN
    public function editPembayaran($id)
    {
        $pembayaran = Pembayaran_Siswa::where('ID_PEMBAYARAN', $id)->first();
        return view('edit_pembayaran', compact('pembayaran'));
    }

    public function updatePembayaran(Request $request, $id)
    {
        try {
            $pembayaran = Pembayaran_Siswa::find($id);
    
            // Update data
            $pembayaran->ID_SISWA = $request->input('ID_SISWA');
            $pembayaran->JUMLAH_PEMBAYARAN = $request->input('JUMLAH_PEMBAYARAN');
            $pembayaran->KATEGORI = $request->input('KATEGORI');
            $pembayaran->TANGGAL_PEMBAYARAN = $request->input('TANGGAL_PEMBAYARAN');
            $pembayaran->save();
    
            // Redirect to the view page after successful update
            return redirect('/lihat_pembayaran_siswa')->with('success', 'Pembayaran berhasil diupdate.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // ======================================================================== DELETE PEMBAYARAN
    
    public function confirmDelete($id)
    {
        $pembayaran = Pembayaran_Siswa::find($id);
        return view('delete_pembayaran', compact('pembayaran'));
    }

    public function deletePembayaran($id)
    {
        try {
            $pembayaran = Pembayaran_Siswa::find($id);
            $pembayaran->delete();

            return redirect('/lihat_pembayaran_siswa')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
}
