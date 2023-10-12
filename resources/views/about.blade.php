<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-[30vh] h-[92vh] p-6 rounded-lg m-8 bg-gradient-to-t from-purple-600 to-purple-400 flex flex-col items-center space-y-10">         
            <div class="w-40 h-40 bg-gradient-to-r from-purple-700 to-purple-500 rounded-2xl flex items-center justify-center mt-4">
                <img src="{{ URL::asset("img/student.svg")}}" alt="Student Icon" class="w-20 h-20">
            </div>
        <ul class="space-y-4">        
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/i.svg")}}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    About
                </a>
            </li>
            <li>
                <a href="/pembayaran" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/payment.svg") }}" alt="Payment Icon" class="w-6 h-6 mr-2 font-bold">
                    Pembayaran
                </a>
            </li>            
            <li>
                <a href="#" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/report.svg")}}" alt="Money Report Icon" class="w-6 h-6 mr-2 font-bold">
                    Money Report
                </a>
            </li>
            <li>
                <a href="/login" class="text-white hover:underline flex items-center">
                    <img src="{{ URL::asset("img/logout.svg")}}" alt="Logout Icon" class="w-6 h-6 mr-2 font-bold">
                    Logout
                </a>
            </li>
        </ul>
    </aside>

        <!-- Main Content -->
        <main class="w-3/4 p-8 flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-6xl font-bold text-gray-900 text-center">Welcome Back, Diaz!</h1>
                <p class="text-2xl text-gray-700 mt-10 text-center">
                    Welcome to our Private School Financial Management System! We offer an efficient and transparent solution for school financial management, including tracking student payments, school income, and expenses.
                </p>
        </div>
        </main>
    </div>
</body>

</html>
