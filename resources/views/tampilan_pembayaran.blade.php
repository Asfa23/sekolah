<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
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
                        <img src="img/payment.svg" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                        Pembayaran
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
            <h1 class="text-5xl font-bold mb-6">Pembayaran</h1>

            <form action="/postPembayaran" method="POST" class="bg-white p-6 rounded shadow-md">
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
                        class="w-[12vh] py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:bg-green-600">
                        Submit
                    </button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
