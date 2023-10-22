<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran_Siswa;
use Illuminate\Http\Request;
use DB;

class SiswaController extends Controller
{
    public function viewHistory(Request $request)
    {
        if (auth()->user()->role == 'siswa') {
            $pembayaranSiswa = Pembayaran_Siswa::all(); // Ganti ini dengan query yang sesuai jika perlu filter data.
            return view('siswa_history', compact('pembayaranSiswa'));
        } else {
            return redirect('dashboard');
        }
    }
}

