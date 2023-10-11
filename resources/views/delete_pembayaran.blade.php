<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Pembayaran</title>
    <!-- Include Tailwind CSS via CDN or import it using your build system -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-poppins">
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
<main class="w-3/5 p-8">
    <h1 class="text-5xl font-bold mb-6">Konfirmasi Hapus Pembayaran</h1>

    <div class="bg-white rounded-lg shadow-md p-6 w-[65vh]">
        <p class="text-lg font-semibold mb-4">Apakah Anda yakin akan menghapus data berikut:</p>

        <div class="mb-3">
            <span class="font-semibold">ID Pembayaran:</span> {{ $pembayaran->ID_PEMBAYARAN }}
        </div>

        <div class="mb-3">
            <span class="font-semibold">ID Siswa:</span> {{ $pembayaran->ID_SISWA }}
        </div>

        <div class="mb-3">
            <span class="font-semibold">Jumlah Pembayaran:</span> {{ $pembayaran->JUMLAH_PEMBYARAN }}
        </div>

        <div class="mb-3">
            <span class="font-semibold">Kategori:</span> {{ $pembayaran->KATEGORI }}
        </div>

        <div class="mb-3">
            <span class="font-semibold">Tanggal Pembayaran:</span> {{ $pembayaran->TANGGAL_PEMBAYARAN }}
        </div>

        <!-- Tombol YES dan NO -->
        <div class="flex mt-6">
            <form action="{{ url('/delete_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-[7vh] py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:bg-red-600">YES</button>
            </form>

            <a href="{{ url('/lihat_pembayaran_siswa') }}">
                <button
                    class="w-[7vh] py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-2">NO</button>
            </a>
        </div>
    </div>
</main>

    </div>
</body>

</html>
