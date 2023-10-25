@extends('layout.main')

@section('contain')

@include('partial.sidebar')

    <main class="w-3/4 p-8">
        <h1 class="text-5xl font-bold mb-6">Konfirmasi Hapus Pengeluaran</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-lg font-semibold mb-4">Apakah Anda yakin akan menghapus data berikut :</p>

            <table class="border border-collapse w-full mb-1">
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


            <div class="flex">
                <form action="{{ url('dashboard/delete_pengeluaran/'.$pengeluaran->ID_PENGELUARAN) }}" method="POST" class="w-full pb-1 pt-4">
                    @csrf
                    @method('DELETE')

                    <div class="mb-4 flex w-full items-center">
                        <label for="alasan" class="flex justify-center items-center text-md font-semibold p-2 bg-red-600 text-white">Alasan</label>
                        <input type="text" name="alasan" id="alasan" class="w-full shadow appearance-none border rounded-r-lg py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan alasan delete" required>
                    </div>

                    <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:bg-red-600">
                        Hapus
                    </button>

                    <a href="/dashboard/lihat_pengeluaran" class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-3">
                         Batal
                    </a>
                </form>
            </div>
            
        </div>
    </main>
@endsection
