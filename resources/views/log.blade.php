@extends('layout.main')

@section('contain')
@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Log Edit & Delete</h1>

    <div class="text-lg font-semibold mb-2 bg-gradient-to-l from-gray-700 to-gray-500 p-1 text-white rounded-md text-center">
        Pemasukan
    </div>
    <div class="bg-white rounded shadow-md p-4">
        <table class="w-full border border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">ID User</th>
                    <th class="border p-2">Jumlah</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Aksi</th>
                    <th class="border p-2 w-[20vw]">Alasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemasukanLogs as $log)
                <tr class="border-b items-center">
                    <td class="border p-2 text-center">{{ $log->ID_USER }}</td>
                    <td class="border p-2 text-center">{{ $log->JUMLAH_UANG }}</td>
                    <td class="border p-2 text-center">{{ $log->KATEGORI }}</td>
                    <td class="border p-2 text-center">{{ $log->TANGGAL_PENGUBAHAN }}</td>
                    <td class="border p-2 text-center">
                        <span class="p-2 pl-5 pr-5 rounded-full text-sm">
                            {{ $log->AKSI }}
                        </span>
                    </td>
                    <td class="border p-2 text-center">{{ $log->ALASAN }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pemasukanLogs->onEachSide(1)->render('custom') }}
    </div>

    <div class="text-lg font-semibold mb-2 bg-gradient-to-l from-gray-700 to-gray-500 p-1 text-white rounded-md text-center mt-8">
        Pengeluaran
    </div>
    <div class="bg-white rounded shadow-md p-4">
        <table class="w-full border border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">ID User</th>
                    <th class="border p-2">Jumlah</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Aksi</th>
                    <th class="border p-2 w-[20vw]">Alasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengeluaranLogs as $logs)
                <tr class="border-b items-center">
                    <td class="border p-2 text-center">{{ $logs->ID_USER }}</td>
                    <td class="border p-2 text-center">{{ $logs->JUMLAH_UANG }}</td>
                    <td class="border p-2 text-center">{{ $logs->KATEGORI }}</td>
                    <td class="border p-2 text-center">{{ $logs->TANGGAL_PENGUBAHAN }}</td>
                    <td class="border p-2 text-center">
                        <span class="p-2 pl-5 pr-5 rounded-full text-sm">
                            {{ $logs->AKSI }}
                        </span>
                    </td>
                    <td class="border p-2 text-center">{{ $logs->ALASAN }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pengeluaranLogs->onEachSide(1)->render('custom') }}
    </div>

</main>
@endsection
