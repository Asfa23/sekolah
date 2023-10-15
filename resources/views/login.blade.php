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

                <!-- dalemnya -->
                <form action="" method="POST">
                    @csrf
                    <div class="flex flex-col items-center">
                        <div class="w-full mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" value="{{ old('email') }}" name="email" class="w-full text-xl bg-gray-200 rounded-lg p-4" placeholder="Masukkan Email">
                        </div>
                        <div class="w-full mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input input type="password" name="password" class="form-control w-full text-xl bg-gray-200 rounded-lg p-4" placeholder="Masukkan Password">
                        </div>
                        <button name="submit" type="submit" class="w-full h-[7vh] bg-black text-white font-semibold rounded-lg mt-6 flex items-center justify-center">
                            Login
                        </button>
                        <!-- <a href="/about" class="w-full h-[7vh] bg-black text-white font-semibold rounded-lg mt-6 flex items-center justify-center">
                            Login
                        </a>                                    -->
                    </div>
                </form>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mt-5">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

        </div>
        <div class="w-[45%] h-screen bg-gradient-to-r from-purple-600 to-purple-400">
        </div>
    </div>
</body>
</html>
