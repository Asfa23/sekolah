<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex">
    <aside class="w-[30vh] h-[92vh] p-6 rounded-lg m-8 bg-gradient-to-t from-purple-600 to-purple-400 flex flex-col items-center space-y-10">         
        <div class="w-40 h-40 bg-gradient-to-r from-purple-700 to-purple-500 rounded-2xl flex items-center justify-center mt-4">
            <img src="{{ URL::asset("img/student.svg") }}" alt="Student Icon" class="w-20 h-20">
        </div>
        <ul class="space-y-4">        
            <li>
                <a href="/dashboard/superAdmin" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/i.svg") }}" alt="About Icon" class="w-6 h-6 mr-2 font-bold">
                    About
                </a>
            </li>
            <li>
                <a href="/dashboard/superAdmin/pembayaran" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/input_pembayaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Input Pembayaran
                </a>
            </li>
            <li>
                <a href="/dashboard/superAdmin/lihat_pembayaran_siswa" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/data_pembayaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Data Pembayaran
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/input_pengeluaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Input Pengeluaran
                </a>
            </li>            
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/data_pengeluaran.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Data Pengeluaran
                </a>
            </li>
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/report.svg") }}" alt="Money Report Icon" class="w-6 h-6 mr-2 font-bold">
                    Money Report
                </a>
            </li>
            <li>
                <a href="/logout" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/logout.svg") }}" alt="Logout Icon" class="w-6 h-6 mr-2 font-bold">
                    Logout
                </a>
            </li>
        </ul>
    </aside>

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

    </div>
</body>

</html>
