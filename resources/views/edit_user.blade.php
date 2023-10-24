@extends('layout.main')

@section('contain')

@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Edit User</h1>
    @if($errors->any() || session()->has('error'))
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-2 py-2 rounded relative mt-2" role="alert">
        <ul>
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @else
                {{session('error')}}
            @endif
        </ul>
    </div>
    @endif
    <form action="{{ url('dashboard/update_user', $user->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf 
        <div class="mb-4">
            <label for="name" class="text-sm font-semibold">Nama:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-input w-full p-2 border rounded">
        </div>
        <div class="mb-4">
            <label for="email" class="text-sm font-semibold">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-input w-full p-2 border rounded">
        </div>
        <div class="mb-4">
            <label for="role" class="text-sm font-semibold">Role:</label>
            @if(auth()->user()->role !== 'superAdmin' || $user->id !== auth()->user()->id)
            <select name="role" id="role" class="form-input w-full p-2 border rounded">
                <option value="siswa" {{ $user->role === 'siswa' ? 'selected' : '' }}>Siswa</option>
                <option value="guru" {{ $user->role === 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
            @else
            <input type="text" value="{{ $user->role }}" class="form-input w-full p-2 border rounded bg-gray-100" readonly>
            @endif
        </div>        
        <div class="mb-4">
            <label for="password" class="text-sm font-semibold">Password Baru:</label>
            <input type="password" name="password" id="password" class="form-input w-full p-2 border rounded">
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="text-sm font-semibold">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input w-full p-2 border rounded">
        </div>          
        <button type="submit" class="btn btn-primary px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600" >
            Simpan
        </button>
        <a href="{{ route('manajemen_user') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-2">
            Kembali
        </a>
    </form>
</main>

@endsection
