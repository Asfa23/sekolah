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
                    <th class="border p-2">ID</th>
                    <th class="border p-2">ID User</th>
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
                    <td class="border p-2 text-center">{{ $pengeluaran->ID_USER}}</td>
                    <td class="border p-2 text-center">Rp {{ number_format($pengeluaran->JUMLAH_PENGELUARAN, 0, ',', '.') }}</td> 
                    <td class="border p-2 text-center">{{ $pengeluaran->KATEGORI }}</td>
                    <td class="border p-2 text-center">{{ $pengeluaran->KETERANGAN}}</td>
                    <td class="border p-2 text-center">{{ $pengeluaran->TANGGAL_PENGELUARAN}}</td>
                    <td class="border p-2 text-center">
                        @if ($pengeluaran->BUKTI_PENGELUARAN)
                        <div class="w-full h-full flex flex-row justify-center items-center">
                            <button class="w-7 h-7 p-1 bg-blue-500 hover-bg-blue-600 rounded-lg" onclick="openModal('{{ asset('storage/BUKTI_PENGELUARAN/' . $pengeluaran->BUKTI_PENGELUARAN) }}')">
                                <img src="{{ URL::asset('img/view.svg') }}" alt="Delete Icon" class="w-5 h-5"/>
                            </button>
                            @endif
                            @if (Auth::user()->role == 'superAdmin')
                            <a href="{{ url('/dashboard/edit_pengeluaran/'.$pengeluaran->ID_PENGELUARAN) }}"
                                class="w-7 h-7 p-1 ml-1.5 rounded-lg transition-colors duration-300 bg-yellow-500 hover-bg-yellow-600">
                                <img src="{{ URL::asset("img/edit.svg") }}" alt = "Edit Icon" class="w-5 h-5"/> 
                            </a>
                            <a href="{{ url('/dashboard/delete_confirmation_pengeluaran/'.$pengeluaran->ID_PENGELUARAN) }}"
                                class="w-7 h-7 p-1 rounded-lg ml-1.5 transition-colors duration-300 bg-red-500 hover-bg-red-600">
                                <img src="{{ URL::asset('img/delete.svg') }}" alt="Delete Icon" class="w-5 h-5"/>
                            </a>
                        </div>
                        @endif
                    </td>                            
                </tr>                    
                @endforeach
            </tbody>
        </table>
        <script>
            function openModal(imageUrl) {
                const modal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = imageUrl;
                modal.style.display = 'block';
            }
            
            function closeModal() {
                const modal = document.getElementById('imageModal');
                modal.style.display = 'none';
            }
        </script>
    
        <div id="imageModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"> 
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <img id="modalImage" src="" alt="Image" class="w-full max-h-screen">
                        </div>  
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button onclick="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover-bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{ $pengeluaranSekolah->onEachSide(1)->render('custom') }}
        </div>
    </main>

@endsection