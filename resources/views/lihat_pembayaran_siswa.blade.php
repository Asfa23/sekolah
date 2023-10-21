@extends('layout.main')

@section('contain')

@include('partial.sidebar')
    <main class="p-8"> 
        <h1 class="text-5xl font-bold mb-6">Data Pembayaran Siswa</h1>
        <div class="bg-white rounded shadow-md p-6">

        <table class="w-full border border-collapse mb-8">
            <thead>
                <tr>
                    <th class="border p-2">ID Pembayaran</th>
                    <th class="border p-2">ID Siswa</th>
                    <th class="border p-2">Jumlah Pembayaran</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Tanggal Pembayaran</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaranSiswa as $pembayaran)
                <tr>
                    <td class="border p-2 text-center">{{ $pembayaran->ID_PEMBAYARAN }}</td>
                    <td class="border p-2 text-center">{{ $pembayaran->ID_SISWA }}</td>
                    <td class="border p-2 text-center">{{ $pembayaran->JUMLAH_PEMBAYARAN }}</td>
                    <td class="border p-2 text-center">{{ $pembayaran->KATEGORI }}</td>
                    <td class="border p-2 text-center">{{ $pembayaran->TANGGAL_PEMBAYARAN }}</td>
                    <td class="border p-2 text-center flex">
                        <a href="{{ url('/dashboard/edit_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}"
                            class="text-white bg-blue-500 hover:bg-blue-600 p-1 px-2 rounded-lg transition-colors duration-300">Edit</a>
                        <a href="{{ url('/dashboard/delete_confirmation/'.$pembayaran->ID_PEMBAYARAN) }}"
                            class="text-white bg-red-500 hover:bg-red-600 p-1 px-2 rounded-lg ml-2 transition-colors duration-300">Delete</a>
                    </td>                            
                </tr>                    
                @endforeach
            </tbody>
        </table>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

    </main>
@endsection