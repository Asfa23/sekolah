@extends('layout.main')

@section('contain')
@include('partial.sidebar')

<main class="w-3/4 p-8"> 
    <h1 class="text-5xl font-bold mb-6">LOG Edit & Delete</h1>
    
    <!-- Bagian Pemasukan -->
    <div class="text-lg font-semibold mb-2 bg-gradient-to-l from-gray-700 to-gray-500 p-1 text-white rounded-md text-center">
        Pemasukan
    </div>
    <div class="bg-white rounded shadow-md p-4">
        <table class="w-full border border-collapse">
            <thead>
                <tr>
                    <!-- <th class="border p-2">ID</th> -->
                    <th class="border p-2">ID User</th>
                    <th class="border p-2">Jumlah</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Tanggal Pengubahan</th>
                    <th class="border p-2">Aksi Terakhir</th>
                    <th class="border p-2 w-[20vw]">Alasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemasukanLogs as $log)
                <tr class="border-b items-center">
                    <!-- ID -->
                    <!-- <td class="border p-2 text-center">{{ $log->ID_LOG }}</td>  -->
                    <!-- ID User -->
                    <td class="border p-2 text-center">{{ $log->ID_USER }}</td>
                    <!-- Jumlah -->
                    <td class="border p-2 text-center">{{ $log->JUMLAH_UANG }}</td>
                    <!-- Kategori -->
                    <td class="border p-2 text-center">{{ $log->KATEGORI }}</td>
                    <!-- Tanggal Pengubahan -->
                    <td class="border p-2 text-center">{{ $log->TANGGAL_PENGUBAHAN }}</td>
                    <!-- Alasan -->
                    <td class="border p-1 text-center">
                        <span class="{{ $log->AKSI === 'DELETE' ? 'bg-red-600' : 'bg-orange-400' }} p-2 pl-5 pr-5 rounded-full font-bold text-white text-sm">
                            {{ $log->AKSI }}
                        </span>
                    </td>
                    <!-- Alasan -->
                    <td class="border p-2 text-center">{{ $log->ALASAN }}</td>                            
                </tr>                    
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bagian Pengeluaran -->
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
                    <th class="border p-2">Tanggal Pengubahan</th>
                    <th class="border p-2">Aksi Terakhir</th>
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
                    <td class="border p-1 text-center">
                        <span class="{{ $logs->AKSI === 'DELETE' ? 'bg-red-600' : 'bg-orange-400' }} p-2 pl-5 pr-5 rounded-full font-bold text-white text-sm">
                            {{ $logs->AKSI }}
                        </span>
                    </td>
                    <td class="border p-2 text-center">{{ $logs->ALASAN }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main>
@endsection
