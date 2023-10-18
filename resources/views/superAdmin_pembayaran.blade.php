<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembayaran</title>
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

        <main class="p-8">
            <h1 class="text-5xl font-bold mb-6">Pembayaran</h1>

            <form action="/dashboard/superAdmin/postPembayaran" method="POST" class="bg-white p-6 rounded shadow-md">
                @csrf 

            <div class="mb-4">
                <label for="ID_SISWA" class="block text-sm font-medium text-gray-700">ID Siswa:</label>
                <input type="number" id="ID_SISWA" name="ID_SISWA" min="1000" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="JUMLAH_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran:</label>
                <input type="number" id="JUMLAH_PEMBAYARAN" name="JUMLAH_PEMBAYARAN" step="0.01" min="0" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="KATEGORI" class="block text-sm font-medium text-gray-700">Kategori:</label>
                <select id="KATEGORI" name="KATEGORI"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="Pembayaran Siswa">Pembayaran Siswa</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="TANGGAL_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran:</label>
                <input type="date" id="TANGGAL_PEMBAYARAN" name="TANGGAL_PEMBAYARAN" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>

                <div class="mt-6">
                    <button type="submit"
                        class="py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">
                        Submit
                    </button>
                </div>
            </form>
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
                    {{ session('error') }}
                </div>
            @endif
        </main>
    </div>
</body>

</html>
