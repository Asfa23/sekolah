<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ManajemenUserController extends Controller
{
    // Main - Manajemen User
    public function index()
    {
        $users = User::all();
        return view('manajemen_user', compact('users'));
    }

    // Edit - Manajemen User
    public function edit($id)
    {
        $user = User::find($id);
        return view('edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:siswa,guru,staff,superAdmin',
            'password' => 'nullable|confirmed|min:8|max:32',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password.min' => 'Password harus memiliki setidaknya 8 karakter.',
            'password.max' => 'Password tidak boleh lebih dari 32 karakter.',
        ]);
    
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
    
        if (!empty($request->password)) {
            if (Hash::check($request->password, $user->password)) {
                return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan password lama.');
            }
            $user->password = bcrypt($request->password);
        }
    
        $user->save();
    
        return redirect()->route('manajemen_user')->with('success', 'Data User berhasil diperbarui.');
    }
    
        // Delete - Manajemen User
        public function showDeleteConfirmation($id)
        {
            $user = User::find($id);
            return view('delete_user', compact('user')); 
        }

        public function delete($id)
        {
            $user = User::find($id);
            $user->delete();

            return redirect()->route('manajemen_user')->with('success', 'Data User berhasil dihapus.');
        }

        // Create - Manajemen User
        public function create()
        {
            return view('create_user');;
        }

        public function store(Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'role' => 'required|in:siswa,guru,staff,superAdmin',
                'password' => 'required|confirmed|min:8|max:32',
            ], [
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
                'password.min' => 'Password harus memiliki setidaknya 8 karakter.',
                'password.max' => 'Password tidak boleh lebih dari 32 karakter.',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('manajemen_user')->with('success', 'Berhasil membuat user baru.');
        }


}
