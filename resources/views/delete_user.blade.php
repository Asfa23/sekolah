@extends('layout.main')

@section('contain')

@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-4">Konfirmasi Hapus User</h1>
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-lg font-semibold mb-4">Apakah anda yakin ingin menghapus user berikut:</p>

        <table class="border border-collapse w-full mb-4">
            <tr>
                <th class="border p-2 font-semibold text-left">ID:</th>
                <td class="border p-2 text-left">{{ $user->id }}</td>
            </tr>
            <tr>
                <th class="border p-2 font-semibold text-left">Nama:</th>
                <td class="border p-2 text-left">{{ $user->name }}</td>
            </tr>
            <tr>
                <th class="border p-2 font-semibold text-left">Email:</th>
                <td class="border p-2 text-left">{{ $user->email }}</td>
            </tr>
            <tr>
                <th class="border p-2 font-semibold text-left">Role:</th>
                <td class="border p-2 text-left">{{ $user->role }}</td>
            </tr>
        </table>
        <form action="{{ route('delete_user', $user->id) }}" method="POST" id="delete-user-form">
            @csrf
            @method('DELETE')
            <div class="flex mt-6">
                <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:bg-red-600">
                    Hapus
                </button>
                <a href="{{ route('manajemen_user') }}" class="py-2 px-5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-3">
                    Batal
                </a>
            </div>
        </form>
    </div>
</main>

@endsection
