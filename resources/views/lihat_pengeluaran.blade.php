@extends('layout.main')

@section('contain')

@include('partial.sidebar')
    <main class="p-8 w-3/4"> 
        <h1 class="text-5xl font-bold mb-6">Data Pengeluaran Sekolah</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button onclick="closeAlert(this)" class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif
    
    <script>
        function closeAlert(button) {
            button.parentElement.style.display = 'none';
        }
    </script>    
        
        <div class="bg-white rounded shadow-md p-6">

        <table class="w-full border border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">ID Pengeluaran</th>
                    <th class="border p-2">Jumlah Pengeluaran</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Keterangan</th>
                    <th class="border p-2">Tanggal Pengeluaran</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengeluaranSekolah as $pengeluaran)
                <tr class="border-b">
                    <td class="border p-2 text-center">{{ $pengeluaran->ID_PENGELUARAN}}</td>
                    <td class="border p-2 text-center">{{ $pengeluaran->JUMLAH_PENGELUARAN}}</td>
                    <td class="border p-2 text-center">{{ $pengeluaran->KATEGORI }}</td>
                    <td class="border p-2 text-center">{{ $pengeluaran->KETERANGAN}}</td>
                    <td class="border p-2 text-center">{{ $pengeluaran->TANGGAL_PENGELUARAN}}</td>
                    <td class="p-2 text-center flex">
                        @if (Auth::user()->role == 'superAdmin')
                        <a href="{{ url('/dashboard/edit_pengeluaran/'.$pengeluaran->ID_PENGELUARAN) }}"
                            class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg transition-colors duration-300 bg-yellow-500 hover-bg-yellow-600">
                            <img src="{{ URL::asset("img/edit.svg") }}" alt = "Edit Icon" class="w-5 h-5"/> 
                        </a>
                        <a href="{{ url('/dashboard/delete_confirmation_pengeluaran/'.$pengeluaran->ID_PENGELUARAN) }}"
                            class="p-1 px-1 h-[3.75vh] rounded-lg ml-1.5 transition-colors duration-300 bg-red-500 hover-bg-red-600">
                            <img src="{{ URL::asset('img/delete.svg') }}" alt="Delete Icon" class="w-5 h-5"/>
                        </a>
                        @endif
                    </td>                            
                </tr>                    
                @endforeach
            </tbody>
        </table>
        </div>
    </main>

@endsection