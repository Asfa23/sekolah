<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pembayaran Siswa</title>
    <!-- Include Tailwind CSS via CDN or import it using your build system -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-[30vh] h-[92vh] p-6 rounded-lg m-8 bg-gradient-to-t from-purple-600 to-purple-400 flex flex-col items-center space-y-10">         
            <div class="w-40 h-40 bg-gradient-to-r from-purple-700 to-purple-500 rounded-2xl flex items-center justify-center mt-4">
                <img src="img/student.svg" alt="Student Icon" class="w-20 h-20">
            </div>
        <ul class="space-y-4">        
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="img/i.svg" alt="About Icon" class="w-6 h-6 mr-2 font-bold">
                    About
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="img/data.svg" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Data Pembayaran
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="img/data.svg" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Data Pengeluaran
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="img/report.svg" alt="Money Report Icon" class="w-6 h-6 mr-2 font-bold">
                    Money Report
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="img/logout.svg" alt="Logout Icon" class="w-6 h-6 mr-2 font-bold">
                    Logout
                </a>
            </li>
        </ul>
    </aside>

        <!-- Main Content -->
        <main class="w-3/4 p-8"> 
            <h1 class="text-5xl font-bold mb-6">Data Pembayaran Siswa</h1>
            <div class="bg-white rounded shadow-md p-6">

            <table class="w-full border border-collapse mb-8">
                <thead>
                    <tr>
                        <th class="border p-2">ID Pembayaran</th>
                        <th class="border p-2">ID Siswa</th>
                        <th class="border p-2">Jumlah Pembayaran</th>
                        <th class="border p-2">Kategori</th>
                        <th class="border p-2">Tanggal Pembayaran</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayaranSiswa as $pembayaran)
                    <tr>
                        <td class="border p-2 text-center">{{ $pembayaran->ID_PEMBAYARAN }}</td>
                        <td class="border p-2 text-center">{{ $pembayaran->ID_SISWA }}</td>
                        <td class="border p-2 text-center">{{ $pembayaran->JUMLAH_PEMBAYARAN }}</td>
                        <td class="border p-2 text-center">{{ $pembayaran->KATEGORI }}</td>
                        <td class="border p-2 text-center">{{ $pembayaran->TANGGAL_PEMBAYARAN }}</td>
                        <td class="border p-2 text-center">
                            <a href="{{ url('/edit_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}"
                                class="text-white bg-blue-500 hover:bg-blue-600 p-1 px-2 rounded-lg transition-colors duration-300">Edit</a>
                            <a href="{{ url('/delete_confirmation/'.$pembayaran->ID_PEMBAYARAN) }}"
                                class="text-white bg-red-500 hover:bg-red-600 p-1 px-2 rounded-lg ml-2 transition-colors duration-300">Delete</a>
                        </td>                            
                    </tr>                    
                    @endforeach
                </tbody>
            </table>

            <a href="{{ url('/pembayaran') }}"
                class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">Tambah Pembayaran</a>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

        </main>
    </div>
</body>

</html>
