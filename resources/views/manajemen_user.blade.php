@extends('layout.main')

@section('contain')
@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Manajemen User</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button onclick="closeAlert(this)" class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
        <button onclick="closeAlert(this)" class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

    <script>
        function closeAlert(button) {
            button.parentElement.style.display = 'none';
        }
    </script> 

    <div class="bg-white rounded shadow-md p-4">
        <div class="mb-5 mt-2 text-right">
            <a href="{{ url('/dashboard/create_user') }}" class="text-white px-4 py-2 rounded-lg transition-colors duration-300 bg-green-500 hover-bg-green-600">
                Create User
            </a>
        </div>           
        <table class="w-full border border-collapse mb-4">
            <thead>
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Role</th> 
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b items-center">
                        <td class="border p-2 text-center">{{ $user->id }}</td>
                        <td class="border p-2 text-center">{{ $user->name }}</td>
                        <td class="border p-2 text-center">{{ $user->email }}</td>
                        <td class="border p-2 text-center">{{ $user->role }}</td>
                        <td class="p-2 text-center flex flex-row justify-center items-center">
                            <a href="{{ url('/dashboard/edit_user/'. $user->id) }}" class="btn btn-primary p-1 px-1 h-[3.75vh] rounded-lg transition-colors duration-300 bg-yellow-500 hover-bg-yellow-600">
                                <img src="{{ URL::asset("img/edit.svg") }}" alt = "Edit Icon" class="w-5 h-5"/>
                            </a>
                            <a href="{{ url('/dashboard/delete_confirmation_user/'. $user->id) }}" class="btn btn-danger p-1 px-1 h-[3.75vh] rounded-lg ml-1.5 transition-colors duration-300 bg-red-500 hover-bg-red-600">
                                <img src="{{ URL::asset('img/delete.svg') }}" alt="Delete Icon" class="w-5 h-5"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->onEachSide(1)->render('custom') }}
    </div>
</main>
@endsection

