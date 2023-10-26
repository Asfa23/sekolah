@extends('layout.main')

@section('contain')
@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Histori Pembayaran</h1>
    <div class="bg-white rounded shadow-md p-4">
        <table class="w-full border border-collapse mb-4">
            <thead>
                <tr>
                    <th class="border p-2">ID Pembayaran</th>
                    <th class="border p-2">Jumlah</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaranSiswa as $pembayaran)
                @if ($pembayaran->ID_USER === auth()->user()->id)
                <tr class="border-b items-center">
                    <td class="border p-2 text-center">{{ $pembayaran->ID_PEMBAYARAN }}</td>
                    <td class="border p-2 text-center">{{ $pembayaran->JUMLAH_PEMBAYARAN }}</td>
                    <td class="border p-2 text-center">{{ $pembayaran->KATEGORI }}</td>
                    <td class="border p-2 text-center">{{ $pembayaran->TANGGAL_PEMBAYARAN }}</td>
                    <td class="border p-2 text-center">
                        @if ($pembayaran->STATUS === 0)
                            PENDING
                        @elseif ($pembayaran->STATUS === 1)
                            VERIFIED
                        @elseif ($pembayaran->STATUS === 2)
                            REJECT
                        @else
                            {{ $pembayaran->STATUS }}
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        
        {{ $pembayaranSiswa->onEachSide(1)->render('custom') }}

    </div>
</main>
@endsection
