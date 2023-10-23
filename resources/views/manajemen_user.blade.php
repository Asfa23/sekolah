@extends('layout.main')

@section('contain')
@include('partial.sidebar')

<main class="w-3/4 p-8">
    <h1 class="text-5xl font-bold mb-6">Manajemen User</h1>
    <div class="bg-white rounded shadow-md p-4">
        <table class="w-full border border-collapse mb-4">
            <thead>
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Role</th>
                    <!-- pass <th class="border p-2">Password</th> --> 
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
                        <!-- pass <td class="border p-2 text-center"> {{ $user->password }}</td> --> 
                        <td class="p-2 text-center flex">
                            <a href="{{ url('/dashboard/edit_user/'. $user->id) }}" class="btn btn-primary ml-6 p-1 px-1 h-[3.75vh] rounded-lg transition-colors duration-300 bg-yellow-500 hover-bg-yellow-600">
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
        <div class="mb-3 mt-7">
        <a href="{{ url('/dashboard/create_user') }}" class="text-white px-4 py-2  rounded-lg transition-colors duration-300 bg-green-500 hover-bg-green-600">
            Create User
        </a>
        </div>
    </div>
    @if(session('success'))
    <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-2 py-2 rounded relative text-sm" role="alert">
        <strong class="font-bold">Sukses!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
</main>
@endsection
