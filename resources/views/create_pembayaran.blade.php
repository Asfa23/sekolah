@extends('layout.main')

@section('contain')

@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Pemasukan</h1>

    <form action="/dashboard/create_pembayaran" method="POST" class="bg-white p-6 rounded shadow-md" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label for="ID_USER" class="block text-sm font-medium text-gray-700">ID User:</label>
            <select name="ID_USER" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                <option value="" disabled selected>Pilih User</option>
                @foreach ($users as $user)
                    @if (auth()->user()->role === 'superAdmin' && $user->role !== 'guru')
                        <option value="{{ $user->id }}">{{ $user->id }}</option>
                    @elseif (auth()->user()->role === 'staff' && ($user->id === auth()->user()->id || ($user->role !== 'guru' && $user->role !== 'superAdmin')))
                        <option value="{{ $user->id }}">{{ $user->id }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        

        <div class="mb-4">
            <label for="JUMLAH_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Jumlah Pemasukan:</label>
            <input type="number" id="JUMLAH_PEMBAYARAN" name="JUMLAH_PEMBAYARAN" step="0.01" min="0" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="KATEGORI" class="block text-sm font-medium text-gray-700">Kategori:</label>
            <select id="KATEGORI" name="KATEGORI" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                <option value="" disabled selected>Pilih Kategori</option>
                <option value="Pembayaran Siswa">Pembayaran Siswa</option>
                <option value="Bantuan Pemerintah">Bantuan Pemerintah</option>
                <option value="Pemasukan Lainnya">Pemasukan Lainnya</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="TANGGAL_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Tanggal Pemasukan:</label>
            <input type="date" id="TANGGAL_PEMBAYARAN" name="TANGGAL_PEMBAYARAN" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="BUKTI_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Bukti Pemasukan(Gambar):</label>
            <input type="file" id="BUKTI_PEMBAYARAN" name="BUKTI_PEMBAYARAN" required accept=".jpg, .jpeg, .png" 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" accept-language="id-ID">
        </div>        

        <div class="mt-6">
            <button type="submit" class="py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">
                Submit
            </button>
        </div>
    </form>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
            {{ session('success') }}
        </div>
    @endif
</main>

@endsection

