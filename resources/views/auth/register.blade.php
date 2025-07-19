@extends('layouts.app')

@section('title', 'Register - Barbershop')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        
@if ($errors->any())
    <div id="registerErrors" class="text-red-400 text-sm mb-4">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
        
       <form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf
    <input type="text" name="username" placeholder="Username" 
           class="w-full px-3 py-2 bg-gray-700 rounded text-white" required>
    <input type="email" name="email" placeholder="Email" 
           class="w-full px-3 py-2 bg-gray-700 rounded text-white" required>
    <input type="password" name="password" placeholder="Password" 
           class="w-full px-3 py-2 bg-gray-700 rounded text-white" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" 
           class="w-full px-3 py-2 bg-gray-700 rounded text-white" required>

    <button type="submit" 
            class="w-full bg-indigo-600 hover:bg-indigo-700 py-2 rounded text-white">
        Register
    </button>
</form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">
                Sudah punya akun? Login di sini
            </a>
        </div>
    </div>
</div>
@endsection