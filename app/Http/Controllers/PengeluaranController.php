<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran_sekolah;
use Illuminate\Http\Request;
use DB;
class PengeluaranController extends Controller
{
    // Buat Submit Pengeluaran
    public function submitPengeluaran(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }

        try {
            $jumlahPengeluaran = $request->input('JUMLAH_PENGELUARAN');
            $kategori = $request->input('KATEGORI');
            $keterangan = $request->input('KETERANGAN_PENGELUARAN');
            $tanggalPengeluaran = $request->input('TANGGAL_PENGELUARAN');
    
            if ($jumlahPengeluaran < 0) {
                return response()->json(['error' => 'Jumlah pembayaran tidak boleh negatif.']);
            }
         
            $today = now();
            if ($tanggalPengeluaran > $today) {
                return redirect('/dashboard/pengeluaran')->with('error', 'Tanggal pembayaran tidak boleh melebihi hari ini.');
            }
    
            $pengeluaran = new pengeluaran_sekolah();
            $pengeluaran->JUMLAH_PENGELUARAN = $jumlahPengeluaran;
            $pengeluaran->KATEGORI = $kategori;
            $pengeluaran->KETERANGAN = $keterangan;
            $pengeluaran->TANGGAL_PENGELUARAN = $tanggalPengeluaran;
    
            $pengeluaran->save();

            $request->session()->flash('success', 'Data Pengeluaran berhasil disimpan.');
    
            return redirect('/dashboard/pengeluaran');
        } catch (\Exception $e) {

            $request->session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
    
            return redirect('/dashboard/pengeluaran');
        }
    }
    //Buat View Pengeluaran
    public function viewPengeluaran(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }
        return view('pengeluaran');
    }

    //Buat View Lihat Pengeluaran
    public function lihatPengeluaran()
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }
        $pengeluaranSekolah= DB::table('pengeluaran_sekolahs')->get();

        return view('lihat_pengeluaran', ['pengeluaranSekolah' => $pengeluaranSekolah]);
    }

    // ======================================================================== EDIT PENGELUARAN
    public function editPengeluaran($id)
    {
        if (auth()->user()->role != 'superAdmin'){
            return redirect('dashboard');
        }
        $pengeluaran = pengeluaran_sekolah::where('ID_PENGELUARAN', $id)->first();
        return view('edit_pengeluaran', compact('pengeluaran'));
    }

    public function updatePengeluaran(Request $request, $id)
    {
        if (auth()->user()->role != 'superAdmin'){
            return redirect('dashboard');
        }
        try {
            $pengeluaran = pengeluaran_sekolah::find($id);

            $pengeluaran->ID_PENGELUARAN = $request->input('ID_PENGELUARAN');
            $pengeluaran->JUMLAH_PENGELUARAN = $request->input('JUMLAH_PENGELUARAN');
            $pengeluaran->KATEGORI = $request->input('KATEGORI');
            $pengeluaran->KETERANGAN = $request->input('KETERANGAN');
            $pengeluaran->TANGGAL_PENGELUARAN = $request->input('TANGGAL_PENGELUARAN');
            $pengeluaran->save();
    
            return redirect('/dashboard/lihat_pengeluaran')->with('success', 'Data Pengeluaran berhasil diperbarui.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // ======================================================================== DELETE PENGELUARAN
    
    public function deletePengeluaran($id)
    {
        try {
            $pengeluaran = pengeluaran_sekolah::find($id);
            $pengeluaran->delete();

            return redirect('/dashboard/lihat_pengeluaran')->with('success', 'Data Pengeluaran berhasil dihapus.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    public function confirmDeletePengeluaran($id)
    {
        $pengeluaran = pengeluaran_sekolah::find($id);
        return view('delete_pengeluaran', compact('pengeluaran'));
    }

}
