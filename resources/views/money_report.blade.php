@extends('layout.main')

@section('contain')

@include('partial.sidebar')
<div class="flex flex-col w-4/5 p-8">
    <main class=""> 
            <h1 class="text-5xl font-bold mb-6">Money Report</h1>
            <div class="bg-white rounded-xl shadow-md p-6">

            <table class="w-full border border-collapse mb-8">
                <thead>
                    <tr>
                        <th class="border p-2">Kategori</th>
                        <th class="border p-2">Total Perkategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($totals as $total)
                    <tr>
                        <td class="border p-2 text-center">{{ $total->KATEGORI }}</td>
                        <td class="border p-2 text-center">Rp {{ $total->TOTAL_PERKATEGORI }}</td>                            
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
    </main>


    @php
        $totalPemasukan = $totals->where('KATEGORI', 'Pembayaran Siswa')->sum('TOTAL_PERKATEGORI');
        $totalPengeluaran = $totals->whereNotIn('KATEGORI', ['Pembayaran Siswa'])->sum('TOTAL_PERKATEGORI');
        $sisa = $totalPemasukan - $totalPengeluaran;
    @endphp

    <div class="mt-6 bg-white rounded-xl shadow-md p-6">
    <h2 class="text-lg font-semibold mb-2">Ringkasan Keuangan</h2>
    <table class="table-auto border w-full">
        <tr class="border">
            <td class="px-4 py-2 border">Total Pemasukan</td>
            <td class="px-4 py-2 border">Rp {{ $totalPemasukan }}</td>
        </tr>
        <tr class="border">
            <td class="px-4 py-2 border">Total Pengeluaran</td>
            <td class="px-4 py-2 border">Rp {{ $totalPengeluaran }}</td>
        </tr>
        <tr class="border">
            <td class="px-4 py-2 border">Sisa</td>
            <td class="px-4 py-2 border">Rp {{ $sisa }}</td>
        </tr>
    </table>
</div>


</div>
@endsection

