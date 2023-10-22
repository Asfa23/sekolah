@extends('layout.main')

@section('contain')
@include('partial.sidebar')

<main class="w-3/4 p-8"> 
    <h1 class="text-5xl font-bold mb-6">Data Pembayaran Siswa</h1>
    <div class="bg-white rounded shadow-md p-4">

    <table class="w-full border border-collapse mb-4">
        <thead>
            <tr>
                <th class="border p-2">ID Pembayaran</th>
                <th class="border p-2">ID Siswa</th>
                <th class="border p-2">Jumlah</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayaranSiswa as $pembayaran)
            <tr class="border-b items-center">
                <td class="border p-2 text-center">{{ $pembayaran->ID_PEMBAYARAN }}</td>
                <td class="border p-2 text-center">{{ $pembayaran->ID_SISWA }}</td>
                <td class="border p-2 text-center">{{ $pembayaran->JUMLAH_PEMBAYARAN }}</td>
                <td class="border p-2 text-center">{{ $pembayaran->KATEGORI }}</td>
                <td class="border p-2 text-center">{{ $pembayaran->TANGGAL_PEMBAYARAN }}</td>
                <td class="border p-2 text-center">
                    @if ($pembayaran->STATUS === 0)
                        N/A
                    @elseif ($pembayaran->STATUS === 1)
                        ACC
                    @else
                        {{ $pembayaran->STATUS }}
                    @endif
                </td>                                 
                <td class="p-2 text-center flex">
                    @if ($pembayaran->BUKTI_PEMBAYARAN)
                        <button class="p-1 px-1 h-[3.75vh] ml-4 bg-blue-500 hover:bg-blue-600 rounded-lg" onclick="openModal('{{ asset('storage/BUKTI_PEMBAYARAN/' . $pembayaran->BUKTI_PEMBAYARAN) }}')">
                            <img src="{{ URL::asset('img/view.svg') }}" alt="Delete Icon" class="w-5 h-5"/>
                        </button>
                    @else
                        No Image
                    @endif
                    <a href="{{ url('/dashboard/edit_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}"
                        class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg transition-colors duration-300 bg-yellow-500 hover:bg-yellow-600">
                        <img src="{{ URL::asset("img/edit.svg") }}" alt="Edit Icon" class="w-5 h-5"/>
                    </a>
                    <form action="{{ url('/dashboard/approve_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}" method="POST">
                        @csrf
                        <button type="submit" class="p-1 px-1 h-[3.75vh] ml-1.5 rounded-lg transition-colors duration-300 bg-green-500 hover:bg-green-600">
                            <img src="{{ URL::asset('img/check.svg') }}" alt="Approve Icon" class="w-5 h-5"/>
                        </button>
                    </form>                                        
                    <a href="{{ url('/dashboard/delete_confirmation/'.$pembayaran->ID_PEMBAYARAN) }}"
                        class="p-1 px-1 h-[3.75vh] rounded-lg ml-1.5 transition-colors duration-300 bg-red-500 hover:bg-red-600">
                        <img src="{{ URL::asset('img/delete.svg') }}" alt="Delete Icon" class="w-5 h-5"/>
                    </a>
                </td>                                                                
            </tr>                    
            @endforeach
        </tbody>
    </table>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-2 py-2 rounded relative mt-2 text-sm" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

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
                    <img id="modalImage" src="" alt="Image" class="w-full">
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover-bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
