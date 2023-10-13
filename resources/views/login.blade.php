<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat Datang!</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-poppins">
    <div class="flex h-screen">
        <div class="w-[60%] p-10 flex flex-col justify-center">
            <h1 class="text-6xl font-bold text-black mb-7 ml-16">Selamat Datang!</h1>
            <div class="w-[40vw] bg-white rounded-xl shadow-md p-10 ml-16">
                <h2 class="text-3xl font-semibold text-black mb-4 mt-1">Login User</h2>
                <div class="flex flex-col items-center mt-8">
                    <div class="w-full mb-4">
                        <input class="w-full text-xl bg-gray-200 rounded-lg p-4" type="text" placeholder="Username">
                    </div>
                    <div class="w-full mb-4">
                        <input class="w-full text-xl bg-gray-200 rounded-lg p-4" type="password" placeholder="Password">
                    </div>
                    <a href="/about" class="w-full h-[7vh] bg-black text-white font-semibold rounded-lg mt-6 flex items-center justify-center">
                        Login
                    </a>                                   
                </div>
            </div>
        </div>
        <div class="w-[45%] h-screen bg-gradient-to-r from-purple-600 to-purple-400">
        </div>
    </div>
</body>
</html>
