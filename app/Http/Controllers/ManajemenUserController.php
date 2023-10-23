<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManajemenUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('manajemen_user', compact('users'));
    }

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
            'password' => 'nullable|confirmed',
        ]);
    
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
    
        // Perbarui kata sandi jika ada kata sandi baru yang dimasukkan
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
    
        $user->save();
    
        return redirect()->route('manajemen_user')->with('success', 'Data berhasil diupdate.');
    }
    

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('manajemen_user')->with('success', 'Data berhasil dihapus.');
    }

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
        'password' => 'required',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('manajemen_user');
}

    public function showDeleteConfirmation($id)
    {
        $user = User::find($id);
        return view('delete_user', compact('user')); 
    }
    

}
