@extends('layout.main')

@section('contain')

@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Pembayaran Siswa</h1>

    <form action="/dashboard/postPembayaran" method="POST" class="bg-white p-6 rounded shadow-md" enctype="multipart/form-data">
        @csrf 

        <div class="mb-4">
            <label for="ID_USER" class="block text-sm font-medium text-gray-700">ID User:</label>
            <input type="text" name="ID_USER" value="{{ auth()->user()->id }}" readonly
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-00 bg-gray-100">
        </div>

    <div class="mb-4">
        <label for="JUMLAH_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran:</label>
        <input type="number" id="JUMLAH_PEMBAYARAN" name="JUMLAH_PEMBAYARAN" step="0.01" min="0" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="KATEGORI" class="block text-sm font-medium text-gray-700">Kategori:</label>
        <input id="KATEGORI" name="KATEGORI"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 bg-gray-100" readonly value="Pembayaran Siswa">
    </div>    

    <div class="mb-4">
        <label for="TANGGAL_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran:</label>
        <input type="date" id="TANGGAL_PEMBAYARAN" name="TANGGAL_PEMBAYARAN" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="BUKTI_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Bukti Pembayaran (Gambar):</label>
        <input type="file" id="BUKTI_PEMBAYARAN" name="BUKTI_PEMBAYARAN" required accept=".jpg, .jpeg, .png" 
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" accept-language="id-ID">
    </div>    

        <div class="mt-6">
            <button type="submit"
                class="py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">
                Submit
            </button>
        </div>
    </form>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
            {{ session('error') }}
        </div>
    @endif
</main>

@endsection