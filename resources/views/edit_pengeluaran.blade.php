@extends('layout.main')

@section('contain')

@include('partial.sidebar')

    <main class="w-3/4 p-8">
        <h1 class="text-5xl font-bold mb-6">Edit Pengeluaran</h1>
        <form action="{{ url('dashboard/update_pengeluaran/' . $pengeluaran->ID_PENGELUARAN) }}" method="POST"
            class="bg-white p-6 rounded shadow-md">
            @csrf
    
            <div class="mb-4">
                <label for="ID_PENGELUARAN" class="block text-sm font-medium text-gray-700">ID User:</label>
                <input type="text" name="ID_PENGELUARAN" value="{{ $pengeluaran->ID_USER }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mb-4">
                <label for="JUMLAH_PENGELUARAN" class="block text-sm font-medium text-gray-700">Jumlah Pengeluran:</label>
                <input type="number" name="JUMLAH_PENGELUARAN" value="{{ $pengeluaran->JUMLAH_PENGELUARAN }}" step="0.01" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mb-4">
                <label for="KATEGORI" class="block text-sm font-medium text-gray-700">Kategori:</label>
                <select name="KATEGORI" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="Inventaris" @if($pengeluaran->KATEGORI == 'Inventaris') selected @endif>Inventaris</option>
                    <option value="Maintenance" @if($pengeluaran->KATEGORI == 'Maintenance') selected @endif>Maintenance</option>
                    <option value="Gaji Guru & Staff" @if($pengeluaran->KATEGORI == 'Gaji Guru & Staff') selected @endif>Gaji Guru & Staff</option>
                    <option value="Program sekolah" @if($pengeluaran->KATEGORI == 'Program sekolah') selected @endif>Program sekolah</option>
                    <option value="Pengeluaran Lainnya" @if($pengeluaran->KATEGORI == 'Pengeluaran Lainnya') selected @endif>Pengeluaran Lainnya</option>
                </select>
            </div>


            <div class="mb-4">
                <label for="KETERANGAN" class="block text-sm font-medium text-gray-700">Keterangan:</label>
                <input type="text" name="KETERANGAN" value="{{ $pengeluaran->KETERANGAN }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mb-4">
                <label for="TANGGAL_PENGELUARAN" class="block text-sm font-medium text-gray-700">Tanggal Pengeluaran:</label>
                <input type="date" name="TANGGAL_PENGELUARAN" value="{{ $pengeluaran->TANGGAL_PENGELUARAN }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mt-6 flex">
                    <button type="submit"
                        class="py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">
                        Update
                    </button>
                    <a href="/dashboard/lihat_pengeluaran" class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-3">
                         Kembali
                    </a>
            </div>                   
        </form>
    </main>

@endsection
