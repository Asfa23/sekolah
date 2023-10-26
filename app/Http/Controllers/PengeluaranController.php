<?php

namespace App\Http\Controllers;

use App\Models\pengeluaran_sekolah;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
class PengeluaranController extends Controller
{
    // ======================================================================== CREATE PENGELUARAN
    public function submitPengeluaran(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }

        try {
            $idUser = auth()->user()->id;
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

            // Images
            $upfile = $request->file('BUKTI_PENGELUARAN');
            $nameimg = time() . '_' . $upfile->getClientOriginalName(); 
            $upfile->storeAs('/BUKTI_PENGELUARAN', $nameimg);
    
            $pengeluaran = new pengeluaran_sekolah();
            $pengeluaran->ID_USER = $idUser;
            $pengeluaran->JUMLAH_PENGELUARAN = $jumlahPengeluaran;
            $pengeluaran->KATEGORI = $kategori;
            $pengeluaran->KETERANGAN = $keterangan;
            $pengeluaran->TANGGAL_PENGELUARAN = $tanggalPengeluaran;
            $pengeluaran->BUKTI_PENGELUARAN = $nameimg;
    
            $pengeluaran->save();

            $request->session()->flash('success', 'Data Pengeluaran berhasil disimpan.');
    
            return redirect('/dashboard/pengeluaran');
        } catch (\Exception $e) {

            $request->session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
    
            return redirect('/dashboard/pengeluaran');
        }
    }
    // ======================================================================== VIEW DATA PENGELUARAN
    public function viewPengeluaran(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }
        return view('pengeluaran');
    }

    public function lihatPengeluaran()
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }
        $pengeluaranSekolah= DB::table('pengeluaran_sekolahs')->paginate(10);

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
            
            $alasan = $request->input('alasan');
    
            $logData = [
                'ID_USER' => $pengeluaran->ID_USER,
                'JUMLAH_UANG' => $pengeluaran->JUMLAH_PENGELUARAN,
                'KATEGORI' => $pengeluaran->KATEGORI,
                'TANGGAL_PENGUBAHAN' => now(),
                'AKSI' => 'EDIT',
                'ALASAN' => $alasan, 
            ];
    
            DB::table('log_edit_delete_pengeluaran')->insert($logData);
    
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
    
            $logzData = [
                'ID_USER' => $pengeluaran->ID_USER,
                'JUMLAH_UANG' => $pengeluaran->JUMLAH_PENGELUARAN,
                'KATEGORI' => $pengeluaran->KATEGORI,
                'TANGGAL_PENGUBAHAN' => now(),
                'AKSI' => 'DELETE',
                'ALASAN' => request('alasan'), 
            ];
    
            DB::table('log_edit_delete_pengeluaran')->insert($logzData);
    
            $pengeluaran->delete();
    
            return redirect('/dashboard/lihat_pengeluaran')->with('success', 'Data Pembayaran berhasil dihapus.');
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
