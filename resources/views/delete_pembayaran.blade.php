<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Konfirmasi Hapus Pembayaran</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-poppins">
    <div class="flex">
         <aside class="w-[30vh] h-[92vh] p-6 rounded-lg m-8 bg-gradient-to-t from-purple-600 to-purple-400 flex flex-col items-center space-y-10">         
            <div class="w-40 h-40 bg-gradient-to-r from-purple-700 to-purple-500 rounded-2xl flex items-center justify-center mt-4">
                <img src="{{ URL::asset("img/student.svg")}}"  alt="Student Icon" class="w-20 h-20">
            </div>
        <ul class="space-y-4">        
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/i.svg")}}"  alt="About Icon" class="w-6 h-6 mr-2 font-bold">
                    About
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/data.svg")}}"  alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Data Pembayaran
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/data.svg")}}"  alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Data Pengeluaran
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/report.svg")}}"  alt="Money Report Icon" class="w-6 h-6 mr-2 font-bold">
                    Money Report
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/logout.svg")}}"  alt="Logout Icon" class="w-6 h-6 mr-2 font-bold">
                    Logout
                </a>
            </li>
        </ul>
    </aside>

    <main class="w-4/5 p-8">
        <h1 class="text-5xl font-bold mb-6">Konfirmasi Hapus Pembayaran</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-lg font-semibold mb-4">Apakah Anda yakin akan menghapus data berikut :</p>

            <div class="mb-3">
                <span class="font-semibold">ID Pembayaran:</span> {{ $pembayaran->ID_PEMBAYARAN }}
            </div>

            <div class="mb-3">
                <span class="font-semibold">ID Siswa:</span> {{ $pembayaran->ID_SISWA }}
            </div>

            <div class="mb-3">
                <span class="font-semibold">Jumlah Pembayaran:</span> {{ $pembayaran->JUMLAH_PEMBAYARAN }}
            </div>

            <div class="mb-3">
                <span class="font-semibold">Kategori:</span> {{ $pembayaran->KATEGORI }}
            </div>

            <div class="mb-3">
                <span class="font-semibold">Tanggal Pembayaran:</span> {{ $pembayaran->TANGGAL_PEMBAYARAN }}
            </div>

            <div class="flex justify-center mt-6">
                <form action="{{ url('/delete_pembayaran/'.$pembayaran->ID_PEMBAYARAN) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:bg-red-600">DELETE</button>
                </form>

                <a href="{{ url('/lihat_pembayaran_siswa') }}">
                    <button
                        class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 ml-2">CANCEL</button>
                </a>
            </div>
        </div>
    </main>

    </div>
</body>

</html>
