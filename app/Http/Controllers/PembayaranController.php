<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use Illuminate\Http\Request;
use DB;
class PembayaranController extends Controller
{
    public function submitPembayaran(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role == 'siswa'){
            return redirect('dashboard');
        }

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
                return redirect('/dashboard/pembayaran')->with('error', 'Tanggal pembayaran tidak boleh melebihi hari ini.');
            }
    
            $pembayaran = new Pembayaran_Siswa();
            $pembayaran->ID_SISWA = $idSiswa;
            $pembayaran->JUMLAH_PEMBAYARAN = $jumlahPembayaran;
            $pembayaran->KATEGORI = $kategori;
            $pembayaran->TANGGAL_PEMBAYARAN = $tanggalPembayaran;
            $pembayaran->save();
    
            $request->session()->flash('success', 'Pembayaran berhasil disimpan.');
    
            return redirect('/dashboard/pembayaran');
        } catch (\Exception $e) {

            $request->session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
    
            return redirect('/dashboard/pembayaran');
        }
    }

    // ======================================================================== PEMBAYARAN
    public function viewPembayaran(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'siswa'){
            return redirect('dashboard');
        }
        return view('pembayaran');
    }

    public function lihatPembayaranSiswa()
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }
        $pembayaranSiswa = DB::table('pembayaran_siswa')->get();

        return view('lihat_pembayaran_siswa', ['pembayaranSiswa' => $pembayaranSiswa]);
    }

    // ======================================================================== EDIT PEMBAYARAN
    public function editPembayaran($id)
    {
        if (auth()->user()->role != 'superAdmin'){
            return redirect('dashboard');
        }
        $pembayaran = Pembayaran_Siswa::where('ID_PEMBAYARAN', $id)->first();
        return view('edit_pembayaran', compact('pembayaran'));
    }

    public function updatePembayaran(Request $request, $id)
    {
        if (auth()->user()->role != 'superAdmin'){
            return redirect('dashboard');
        }
        try {
            $pembayaran = Pembayaran_Siswa::find($id);

            $pembayaran->ID_SISWA = $request->input('ID_SISWA');
            $pembayaran->JUMLAH_PEMBAYARAN = $request->input('JUMLAH_PEMBAYARAN');
            $pembayaran->KATEGORI = $request->input('KATEGORI');
            $pembayaran->TANGGAL_PEMBAYARAN = $request->input('TANGGAL_PEMBAYARAN');
            $pembayaran->save();
    
            return redirect('/dashboard/lihat_pembayaran_siswa')->with('success', 'Pembayaran berhasil diupdate.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // ======================================================================== DELETE PEMBAYARAN
    
    public function deletePembayaran($id)
    {
        try {
            $pembayaran = Pembayaran_Siswa::find($id);
            $pembayaran->delete();

            return redirect('/dashboard/lihat_pembayaran_siswa')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    public function confirmDelete($id)
    {
        $pembayaran = Pembayaran_Siswa::find($id);
        return view('delete_pembayaran', compact('pembayaran'));
    }
}
