@extends('layout.main')

@section('contain')

@include('partial.sidebar')
        

<main class="w-3/4 p-8 flex items-center justify-center">
    <div class="text-center">
    <h1 class="text-7xl font-bold text-gray-900 text-center">
        Selamat Datang!
    </h1>
    <h1 class="text-7xl font-bold text-gray-900 text-center mt-2">
        @if (Auth::check())
        {{ Auth::user()->name }}
        @endif
    </h1>

        <p class="text-2xl text-gray-700 mt-10 text-center">
            Selamat datang di Sistem Manajemen Keuangan Sekolah! Kami menawarkan solusi yang efisien dan transparan untuk pengelolaan keuangan sekolah, termasuk melacak pembayaran siswa, pendapatan sekolah, dan pengeluaran.
        </p>
</div>
</main>

@endsection