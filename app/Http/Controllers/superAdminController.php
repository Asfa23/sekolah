<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran_Siswa;
use App\Models\User;
use DBl;

class superAdminController extends Controller
{
    // ======================================================================== CREATE PEMBAYARAN - STAFF & SUPERADMIN
    public function showForm()
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }
        $users = User::all();

        return view('create_pembayaran', ['users' => $users]);
    }

    public function submitPembayaran(Request $request)
    {
        try {
            $idUser = $request->input('ID_USER');
            $jumlahPembayaran = $request->input('JUMLAH_PEMBAYARAN');
            $kategori = $request->input('KATEGORI');
            $tanggalPembayaran = $request->input('TANGGAL_PEMBAYARAN');

            if ($jumlahPembayaran < 0) {
                return redirect('/dashboard/create_pembayaran')->with('error', 'Jumlah pembayaran tidak boleh negatif.');
            }

            $status = (auth()->user()->role == 'superAdmin' || auth()->user()->role == 'staff') ? 1 : 0;

            $upfile = $request->file('BUKTI_PEMBAYARAN');
            $nameimg = time() . '_' . $upfile->getClientOriginalName();
            $upfile->storeAs('/BUKTI_PEMBAYARAN', $nameimg);

            $pembayaran = new Pembayaran_Siswa();
            $pembayaran->ID_USER = $idUser;
            $pembayaran->JUMLAH_PEMBAYARAN = $jumlahPembayaran;
            $pembayaran->KATEGORI = $kategori;
            $pembayaran->TANGGAL_PEMBAYARAN = $tanggalPembayaran;
            $pembayaran->BUKTI_PEMBAYARAN = $nameimg;
            $pembayaran->STATUS = $status;

            $pembayaran->save();
            $request->session()->flash('success', 'Data Pembayaran berhasil disimpan.');
            return redirect('/dashboard/create_pembayaran');
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect('/dashboard/create_pembayaran');
        }
    }
}
