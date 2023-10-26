<?php

namespace App\Http\Controllers;

use App\Models\LogEditDeletePem;
use App\Models\Pembayaran_Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class PembayaranController extends Controller
{
    // ======================================================================== CREATE PEMBAYARAN - SISWA
    public function submitPembayaran(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role !== 'siswa' && auth()->user()->role !== 'staff') {
            return redirect('dashboard');
        }
    
        try {
            $idUser = auth()->user()->id; 
            $jumlahPembayaran = $request->input('JUMLAH_PEMBAYARAN');
            $tanggalPembayaran = $request->input('TANGGAL_PEMBAYARAN');
    
            if ($jumlahPembayaran < 0) {
                return response()->json(['error' => 'Jumlah pembayaran tidak boleh negatif.']);
            }
    
            $today = now();
            if ($tanggalPembayaran > $today) {
                return redirect('/dashboard/pembayaran')->with('error', 'Tanggal pembayaran tidak boleh melebihi hari ini.');
            }

            $kategori = 'Pembayaran Siswa';
    
            // Images
            $upfile = $request->file('BUKTI_PEMBAYARAN');
            $nameimg = time() . '_' . $upfile->getClientOriginalName(); 
            $upfile->storeAs('/BUKTI_PEMBAYARAN', $nameimg);
    
            $pembayaran = new Pembayaran_Siswa();
            $pembayaran->ID_USER = $idUser; 
            $pembayaran->JUMLAH_PEMBAYARAN = $jumlahPembayaran;
            $pembayaran->KATEGORI = $kategori;
            $pembayaran->TANGGAL_PEMBAYARAN = $tanggalPembayaran;
            $pembayaran->BUKTI_PEMBAYARAN = $nameimg;
    
            $pembayaran->save();
            $request->session()->flash('success', 'Data Pembayaran berhasil disimpan.');
            return redirect('/dashboard/pembayaran');
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect('/dashboard/pembayaran');
        }
    }

    // ======================================================================== VIEW DATA PEMBAYARAN
    public function viewPembayaran(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role !== 'siswa' && auth()->user()->role !== 'staff'){
            return redirect('dashboard');
        }
        return view('pembayaran');
    }

    public function lihatPembayaranSiswa()
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }
        $pembayaranSiswa = DB::table('pembayaran_siswa')->paginate(10);

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
            
            $alasan = $request->input('alasan'); 
    
            $logData = [
                'ID_USER' => $pembayaran->ID_USER,
                'JUMLAH_UANG' => $pembayaran->JUMLAH_PEMBAYARAN,
                'KATEGORI' => $pembayaran->KATEGORI,
                'TANGGAL_PENGUBAHAN' => now(),
                'AKSI' => 'EDIT',
                'ALASAN' => $alasan,
            ];
    
            DB::table('log_edit_delete_pemasukan')->insert($logData);
    
            $pembayaran->ID_USER = $request->input('ID_USER');
            $pembayaran->JUMLAH_PEMBAYARAN = $request->input('JUMLAH_PEMBAYARAN');
            $pembayaran->KATEGORI = $request->input('KATEGORI');
            $pembayaran->TANGGAL_PEMBAYARAN = $request->input('TANGGAL_PEMBAYARAN');
            $pembayaran->save();
    
            return redirect('/dashboard/lihat_pembayaran_siswa')->with('success', 'Data Pembayaran berhasil diperbarui.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    

    // ======================================================================== DELETE PEMBAYARAN
    
    public function deletePembayaran($id)
    {
        try {
            $pembayaran = Pembayaran_Siswa::find($id);
    
            $logData = [
                'ID_USER' => $pembayaran->ID_USER,
                'JUMLAH_UANG' => $pembayaran->JUMLAH_PEMBAYARAN,
                'KATEGORI' => $pembayaran->KATEGORI,
                'TANGGAL_PENGUBAHAN' => now(),
                'AKSI' => 'DELETE',
                'ALASAN' => request('alasan'),
            ];
    
            
            DB::table('log_edit_delete_pemasukan')->insert($logData);
    
            $pembayaran->delete();
    
            return redirect('/dashboard/lihat_pembayaran_siswa')->with('success', 'Data Pembayaran berhasil dihapus.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // ======================================================================== CONFIRM PEMBAYARAN
    
    public function confirmDeletePembayaran($id)
    {
        $pembayaran = Pembayaran_Siswa::find($id);
        return view('delete_pembayaran', compact('pembayaran'));
    }

    public function approvePembayaran($id)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff') {
            return redirect('/dashboard/lihat_pembayaran_siswa')->with('error', 'Anda tidak diizinkan menyetujui pembayaran.');
        }
        DB::table('pembayaran_siswa')->where('ID_PEMBAYARAN', $id)->update(['STATUS' => 1]);

        return redirect('/dashboard/lihat_pembayaran_siswa')->with('success', 'Pembayaran telah disetujui.');
    }

     // ======================================================================== REJECT PEMBAYARAN

    public function rejectPembayaran($id)
    {

        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff') {
            return redirect('/dashboard/lihat_pembayaran_siswa')->with('error', 'Anda tidak diizinkan menolak pembayaran.');
        }
    
        DB::table('pembayaran_siswa')->where('ID_PEMBAYARAN', $id)->update(['STATUS' => 2]);
    
        return redirect('/dashboard/lihat_pembayaran_siswa')->with('success', 'Pembayaran telah ditolak.');
    }
    
}
