<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Pembayaran</title>
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

    <main class="w-3/5 p-8">
        <h1 class="text-5xl font-bold mb-6">Edit Pembayaran</h1>
        <form action="{{ url('/update_pembayaran/' . $pembayaran->ID_PEMBAYARAN) }}" method="POST"
            class="bg-white p-6 rounded shadow-md">
            @csrf
    
            <div class="mb-4">
                <label for="ID_SISWA" class="block text-sm font-medium text-gray-700">ID Siswa:</label>
                <input type="text" name="ID_SISWA" value="{{ $pembayaran->ID_SISWA }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mb-4">
                <label for="JUMLAH_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran:</label>
                <input type="number" name="JUMLAH_PEMBAYARAN" value="{{ $pembayaran->JUMLAH_PEMBAYARAN }}" step="0.01" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mb-4">
                <label for="KATEGORI" class="block text-sm font-medium text-gray-700">Kategori:</label>
                <input type="text" name="KATEGORI" value="{{ $pembayaran->KATEGORI }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mb-4">
                <label for="TANGGAL_PEMBAYARAN" class="block text-sm font-medium text-gray-700">Tanggal Pembayaran:</label>
                <input type="date" name="TANGGAL_PEMBAYARAN" value="{{ $pembayaran->TANGGAL_PEMBAYARAN }}" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
    
            <div class="mt-6 flex">
                <div class="flex-2">
                    <button type="submit"
                        class="w-[13vh] py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">
                        Update
                    </button>
                </div>
                <div class="ml-3">
                    <button onclick="window.location.href='{{ url('/lihat_pembayaran_siswa') }}'" class="w-[13vh] py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                         Kembali
                    </button>
                </div>
            </div>                   
        </form>
    </main>

    </div>
</body>

</html>
