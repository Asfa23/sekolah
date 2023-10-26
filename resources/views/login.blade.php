<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ URL::asset("img/logo_sekolah.png") }}" type="image/png">
    <title>SchooLens</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white font-poppins">
    <div class="flex h-screen">
        <div class="w-[60%] p-10 flex flex-col justify-center">
            <h1 class="text-6xl font-bold text-black mb-7 ml-16">Selamat Datang!</h1>
            
            <div class="w-[40vw] bg-white rounded-xl shadow-xl p-10 ml-16 backdrop-blur-md  hover:border-purple-600 hover:border-[3px] hover:ease-in duration-300 hover:scale-101">
                <form action="" method="POST">
                    @csrf
                    <div class="flex flex-col items-center">
                        <div class="w-full mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" value="{{ old('email') }}" name="email" class="w-full text-xl bg-gray-200 rounded-lg p-4" placeholder="Masukkan Email">
                        </div>
                        <div class="w-full mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="w-full text-xl bg-gray-200 rounded-lg p-4" placeholder="Masukkan Password">
                        </div>
                        <button name="submit" type="submit" class="w-full h-[7vh] bg-gradient-to-r from-purple-600 to-purple-400 text-white font-semibold rounded-lg mt-6 flex items-center justify-center transform hover:scale-105 delay-150 duration-200 ease-in-out">
                            Login
                        </button>
                    </div>
                </form>
            </div>

            @if($errors->any())
                <div class="w-[40vw] ml-16 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mt-5">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
        <div class="w-[45%] h-screen relative">
            <video autoplay muted loop id="bg-video" class="w-full h-full object-cover">
                <source src="{{ URL::asset('img/bg_login.mp4') }}" type="video/mp4">
            </video>
        </div>
    </div>
</body>
</html>
