<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogEditDeletePemasukan;
use App\Models\LogEditDeletePengeluaran; // Tambahkan ini
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function viewLog(Request $request)
    {
        if (auth()->user()->role != 'superAdmin' && auth()->user()->role != 'staff'){
            return redirect('dashboard');
        }

        $pemasukanLogs = LogEditDeletePemasukan::paginate(3, ['*'], 'pemasukanLogs');
        $pengeluaranLogs = LogEditDeletePengeluaran::paginate(3, ['*'], 'pengeluaranLogs');

        return view('log', compact('pemasukanLogs', 'pengeluaranLogs')); // Perbarui compact
    }
}

