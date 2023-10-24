@extends('layout.main')

@section('contain')

@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Create User</h1>

    <form action="{{ url('/dashboard/store_user') }}" method="POST" class="bg-white rounded shadow-md p-6">
        @csrf

        <div class="mb-4">
            <label for="name" class="text-sm font-semibold">Name:</label>
            <input type="text" name="name" id="name" class="form-input w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="text-sm font-semibold">Email:</label>
            <input type="email" name="email" id="email" class="form-input w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="role" class="text-sm font-semibold">Role:</label>
            <select name="role" id="role" class="form-input w-full p-2 border rounded" required>
                <option selected disabled>Pilih Role</option>
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
                <option value="staff">Staff</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="password" class="text-sm font-semibold">Password:</label>
            <input type="password" name="password" id="password" class="form-input w-full p-2 border rounded" required>
        </div>

        <div class="">
            <label for="password_confirmation" class="text-sm font-semibold">Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input w-full p-2 border rounded" required>
        </div>

        <div class="flex space-x-4 mt-6">
            <button type="submit" class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">
                Create
            </button>

            <a href="{{ route('manajemen_user') }}" class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-3">
                Kembali
            </a>
        </div>
    </form>
    @if($errors->any())
            <div class="mt-6 bg-red-100 border border-red-400 text-red-700 px-2 py-2 rounded relative mt-2 text-sm" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
</main>

@endsection
