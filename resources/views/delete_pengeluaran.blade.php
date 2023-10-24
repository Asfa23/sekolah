@extends('layout.main')

@section('contain')

@include('partial.sidebar')

    <main class="w-3/4 p-8">
        <h1 class="text-5xl font-bold mb-6">Konfirmasi Hapus Pengeluaran</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-lg font-semibold mb-4">Apakah Anda yakin akan menghapus data berikut :</p>

            <table class="border border-collapse w-full mb-3">
                <tr>
                    <th class="border p-2 font-semibold text-left">ID Pengeluaran:</th>
                    <td class="border p-2 text-left">{{ $pengeluaran->ID_PENGELUARAN }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">Jumlah Pengeluaran:</th>
                    <td class="border p-2 text-left">{{ $pengeluaran->JUMLAH_PENGELUARAN }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">Kategori:</th>
                    <td class="border p-2 text-left">{{ $pengeluaran->KATEGORI }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">Keterangan:</th>
                    <td class="border p-2 text-left">{{ $pengeluaran->KETERANGAN }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">Tanggal Pengeluaran:</th>
                    <td class="border p-2 text-left">{{ $pengeluaran->TANGGAL_PENGELUARAN }}</td>
                </tr>
            </table>


            <div class="flex mt-6">
                <form action="{{ url('dashboard/delete_pengeluaran/'.$pengeluaran->ID_PENGELUARAN) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:bg-red-600">Hapus</button>
                </form>

                <a href="{{ url('dashboard/lihat_pengeluaran') }}">
                    <button
                        class="py-2 px-5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-3">Batal</button>
                </a>
            </div>
        </div>
    </main>
@endsection
