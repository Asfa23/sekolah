@extends('layout.main')

@section('contain')

@include('partial.sidebar')

    <main class="w-3/4 p-8">
        <h1 class="text-5xl font-bold mb-6">Edit Pembayaran</h1>
        <form action="{{ url('dashboard/update_pembayaran/' . $pembayaran->ID_PEMBAYARAN) }}" method="POST"
            class="bg-white p-6 rounded shadow-md">
            @csrf
    
            <div class="mb-4">
                <label for="ID_USER" class="block text-sm font-medium text-gray-700">ID Siswa:</label>
                <input type="text" name="ID_USER" value="{{ $pembayaran->ID_USER }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mb-4">
                <label for="JUMLAH_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran:</label>
                <input type="number" name="JUMLAH_PEMBAYARAN" value="{{ $pembayaran->JUMLAH_PEMBAYARAN }}" step="0.01" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="KATEGORI" class="block text-sm font-medium text-gray-700">Kategori:</label>
                <select name="KATEGORI" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="Pembayaran Siswa" @if($pembayaran->KATEGORI == 'Pembayaran Siswa') selected @endif>Pembayaran Siswa</option>
                    <option value="Bantuan Pemerintah" @if($pembayaran->KATEGORI == 'Bantuan Pemerintah') selected @endif>Bantuan Pemerintah</option>
                    <option value="Pemasukan Lainnya" @if($pembayaran->KATEGORI == 'Pemasukan Lainnya') selected @endif>Pemasukan Lainnya</option>
                </select>
            </div>
    
            <div class="mb-4">
                <label for="TANGGAL_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran:</label>
                <input type="date" name="TANGGAL_PEMBAYARAN" value="{{ $pembayaran->TANGGAL_PEMBAYARAN }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4 flex">
                <label for="alasan" class="flex justify-center items-center text-md font-semibold p-2 bg-red-600 text-white">Alasan</label>
                <input type="text" name="alasan" id="alasan" value="{{ $pembayaran->ALASAN }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan alasan update" required>
            </div>
    
            <div class="mt-6 flex">
                <button type="submit"
                    class="py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">
                    Update
                </button>
                <a href="/dashboard/lihat_pembayaran_siswa" class="ml-3 py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    Kembali
                </a>
            </div>                   
        </form>


    </main>

@endsection
