@extends('layout.main')

@section('contain')

@include('partial.sidebar')

    <main class="w-4/5 p-8">
        <h1 class="text-5xl font-bold mb-6">Konfirmasi Hapus Pembayaran</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-lg font-semibold mb-4">Apakah Anda yakin akan menghapus data berikut :</p>

            <div class="mb-3">
                <span class="font-semibold">ID Pembayaran:</span> {{ $pembayaran->ID_PEMBAYARAN }}
            </div>

            <div class="mb-3">
                <span class="font-semibold">ID Siswa:</span> {{ $pembayaran->ID_SISWA }}
            </div>

            <div class="mb-3">
                <span class="font-semibold">Jumlah Pembayaran:</span> {{ $pembayaran->JUMLAH_PEMBAYARAN }}
            </div>

            <div class="mb-3">
                <span class="font-semibold">Kategori:</span> {{ $pembayaran->KATEGORI }}
            </div>

            <div class="mb-3">
                <span class="font-semibold">Tanggal Pembayaran:</span> {{ $pembayaran->TANGGAL_PEMBAYARAN }}
            </div>

            <div class="flex justify-center mt-6">
                <form action="{{ url('dashboard/delete_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:bg-red-600">DELETE</button>
                </form>

                <a href="{{ url('dashboard/lihat_pembayaran_siswa') }}">
                    <button
                        class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-2">CANCEL</button>
                </a>
            </div>
        </div>
    </main>
@endsection
