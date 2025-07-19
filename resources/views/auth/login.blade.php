@extends('layouts.app')

@section('title', 'Login - Barbershop')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        
@if ($errors->any())
    <div id="loginErrors" class="text-red-400 text-sm mb-4">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <input type="text" name="email" placeholder="email" 
                   class="w-full px-3 py-2 bg-gray-700 rounded text-white" required>
            <input type="password" name="password" placeholder="Password" 
                   class="w-full px-3 py-2 bg-gray-700 rounded text-white" required>
            <button type="submit" 
                    class="w-full bg-indigo-600 hover:bg-indigo-700 py-2 rounded text-white">
                Login
            </button>
        </form>
        
        <div class="text-center mt-4">
            <a href="{{ route('register') }}" class="text-indigo-400 hover:underline">
                Belum punya akun? Daftar di sini
            </a>
        </div>
    </div>
</div>
@endsection