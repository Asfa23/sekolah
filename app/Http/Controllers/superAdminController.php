<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran_Siswa;
use App\Models\User;
use DBl;

class superAdminController extends Controller
{
    public function showForm()
    {
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

            // Set default status to 1 for superAdmin
            $status = auth()->user()->role == 'superAdmin' ? 1 : 0;

            // Images
            $upfile = $request->file('BUKTI_PEMBAYARAN');
            $nameimg = time() . '_' . $upfile->getClientOriginalName(); // Menggunakan nama asli berkas
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
