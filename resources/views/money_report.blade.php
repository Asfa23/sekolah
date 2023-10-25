@extends('layout.main')

@section('contain')

@include('partial.sidebar')
<div class="flex flex-col w-3/4 p-8">
<main class="">
        <h1 class="text-5xl font-bold mb-6">Money Report</h1>

        <!-- ini yg tabel bawahnya -->
        @php
        $totalPemasukan = $totals->whereIn('KATEGORI', ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya'])->sum('TOTAL_PERKATEGORI');
        $totalPengeluaran = $totals->whereNotIn('KATEGORI', ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya'])->sum('TOTAL_PERKATEGORI');
        $sisa = $totalPemasukan - $totalPengeluaran;
        @endphp
        
        <div class="text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center">
            Alokasi Dana
        </div>
        <div class="mt-2 bg-white rounded-lg shadow-md p-6">
        <table class="table-auto border w-full">
        <tr class="border">
            <td class="px-4 py-2 border font-semibold">Total Pemasukan</td>
            <td class="px-4 py-2 border">Rp {{ $totalPemasukan }}</td>
        </tr>
        <tr class="border">
            <td class="px-4 py-2 border font-semibold ">Total Pengeluaran</td>
            <td class="px-4 py-2 border">Rp {{ $totalPengeluaran }}</td>
        </tr>
        <tr class="border ">
            <td class="px-4 py-2 border font-semibold ">Dana Tersisa</td>
            <td class="px-4 py-2 border">Rp {{ $sisa }}</td>
        </tr>
        </table>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-6">
            <!-- Tabel Pemasukan -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-3 text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center">
                    Alokasi Pemasukan Perkategori
                </div>
                <table class="w-full border border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totals as $total)
                            @if(in_array($total->KATEGORI, ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya']))
                            <tr>
                                <td class="border p-2 text-center">{{ $total->KATEGORI }}</td>
                                <td class="border p-2 text-center">Rp {{ $total->TOTAL_PERKATEGORI }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        
            <!-- Tabel Pengeluaran -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="mb-3 text-lg font-semibold bg-gradient-to-l from-purple-700 to-purple-500 p-1 text-white rounded-md text-center">
                    Alokasi Pengeluaran Perkategori
                </div>
                <table class="w-full border border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totals as $total)
                            @if(!in_array($total->KATEGORI, ['Pembayaran Siswa', 'Bantuan Pemerintah', 'Pemasukan Lainnya']))
                            <tr>
                                <td class="border p-2 text-center">{{ $total->KATEGORI }}</td>
                                <td class="border p-2 text-center">Rp {{ $total->TOTAL_PERKATEGORI }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </main>

</div>
@endsection

