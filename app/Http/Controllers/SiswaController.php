<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use Illuminate\Http\Request;
use DB;

class SiswaController extends Controller
{
    // ======================================================================== HISTORI PEMBAYARAN SISWA 
    public function viewHistory(Request $request)
    {
        if (auth()->user()->role == 'siswa') {
            $pembayaranSiswa = Pembayaran_Siswa::paginate(10); 
            return view('siswa_history', compact('pembayaranSiswa'));
        } else {
            return redirect('dashboard');
        }
    }
}


