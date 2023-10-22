@extends('layout.main')

@section('contain')

@include('partial.sidebar')

    <main class="w-4/5 p-8">
        <h1 class="text-5xl font-bold mb-6">Konfirmasi Hapus Pembayaran</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-lg font-semibold mb-4">Apakah Anda yakin akan menghapus data berikut :</p>

            <table class="border border-collapse w-full mb-3">
                <tr>
                    <th class="border p-2 font-semibold text-left">ID Pembayaran</th>
                    <td class="border p-2 text-left">{{ $pembayaran->ID_PEMBAYARAN }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">ID Siswa</th>
                    <td class="border p-2 text-left">{{ $pembayaran->ID_SISWA }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">Jumlah Pembayaran</th>
                    <td class="border p-2 text-left">{{ $pembayaran->JUMLAH_PEMBAYARAN }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">Kategori</th>
                    <td class="border p-2 text-left">{{ $pembayaran->KATEGORI }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">Tanggal Pembayaran</th>
                    <td class="border p-2 text-left">{{ $pembayaran->TANGGAL_PEMBAYARAN }}</td>
                </tr>
                <tr>
                    <th class="border p-2 font-semibold text-left">Bukti Pembayaran</th>
                    <td class="border p-2 text-left">
                        <img src="{{ asset('storage/BUKTI_PEMBAYARAN/' . $pembayaran->BUKTI_PEMBAYARAN) }}" alt="Bukti Pembayaran" class="w-[30rem]" />
                    </td>
                </tr>
            </table>


            <div class="flex justify-center mt-6">
                <form action="{{ url('dashboard/delete_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:bg-red-600">DELETE</button>
                </form>

                <a href="{{ url('dashboard/lihat_pembayaran_siswa') }}" >
                    <button
                        class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-2">CANCEL
                    </button>
                </a>

            </div>
        </div>
    </main>
@endsection
