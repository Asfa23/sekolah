@extends('layout.main')

@section('contain')

@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Input Pengeluaran</h1>

    <form action="/dashboard/postPengeluaran" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf 

    <div class="mb-4">
        <label for="JUMLAH_PENGELUARAN" class="block text-sm font-medium text-gray-700">Jumlah Pengeluaran:</label>
        <input type="number" id="JUMLAH_PENGELUARAN" name="JUMLAH_PENGELUARAN" step="0.01" min="0" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="KATEGORI" class="block text-sm font-medium text-gray-700">Kategori:</label>
        <select id="KATEGORI" name="KATEGORI"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            <option selected disabled>Pilih Kategori</option>
            <option value="Maintenance">Maintenance</option>
            <option value="Inventaris">Inventaris</option>
            <option value="Gaji Guru & Staff">Gaji Guru & Staff</option>
            <option value="Program Sekolah">Program Sekolah</option>
            <option value="Pengeluaran Lainnya">Pengeluaran Lainnya</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="KETERANGAN_PENGELUARAN" class="block text-sm font-medium text-gray-700">Keterangan:</label>
        <input type="text" id="KETERANGAN_PENGELUARAN" name="KETERANGAN_PENGELUARAN" step="0.01" min="0" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="TANGGAL_PENGELUARAN" class="block text-sm font-medium text-gray-700">Tanggal Pengeluaran:</label>
        <input type="date" id="TANGGAL_PENGELUARAN" name="TANGGAL_PENGELUARAN" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
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
