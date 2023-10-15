<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];

        if(auth::attempt($infologin)){
            if (Auth::user()->role == 'siswa') {
                return redirect('dashboard/siswa');
            } elseif (Auth::user()->role == 'guru') {
                return redirect('dashboard/guru') ;
            } elseif (Auth::user()->role == 'staff') {
                return redirect('dashboard/staff');
            } elseif (Auth::user()->role == 'superAdmin') {
                return redirect('dashboard/superAdmin');
            }
        } else {
            return redirect('')->withErrors('Username dan Password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout() 
    {
        Auth::logout();
        return redirect('');
    }
}
