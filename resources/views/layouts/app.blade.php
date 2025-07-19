<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barbershop')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-900 text-white"
x-data="{
    showLogin: {{ session('showLogin') ? 'true' : 'false' }},
    showRegister: {{ session('errors') && old('username') ? 'true' : 'false' }},
    showLoginError: {{ session('errors') && old('email') ? 'true' : 'false' }},
    showRegisterError: {{ session('errors') && old('username') ? 'true' : 'false' }},
    showLoginPrompt: false,
    loginReason: '',
    @auth isLoggedIn: true @else isLoggedIn: false @endauth,

    closeLogin() {
        this.showLogin = false;
        this.showLoginError = false;
    },
    closeRegister() {
        this.showRegister = false;
        this.showRegisterError = false;
    }
}"
>

@if (!Request::is('jadwal'))
<!-- Navbar -->
<nav class="sticky top-0 z-50 flex items-center justify-between px-6 py-4 bg-gray-800 shadow">
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-10 h-10 rounded-full">
        <span class="text-xl font-bold">Barbertro</span>
    </div>

    <div class="flex items-center space-x-4">
        <a href="{{ route('home') }}#home" class="hover:text-indigo-400 transition">Home</a>
        <a href="{{ route('home') }}#service" class="hover:text-indigo-400 transition">Service</a>
        <a href="{{ route('home') }}#gallery" class="hover:text-indigo-400 transition">Gallery</a>
        <a href="{{ route('home') }}#produk" class="hover:text-indigo-400 transition">Product</a>
        <a href="{{ route('home') }}#about" class="hover:text-indigo-400 transition">About</a>

        <!-- Jadwal -->
        <a 
            href="#" 
            @click.prevent="
                if (!isLoggedIn) {
                    showLoginPrompt = true;
                } else {
                    window.location.href = '{{ route('jadwal') }}';
                }
            "
            class="hover:text-indigo-400 transition"
        >
            Jadwal
        </a>

        @auth
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                     Logout
                </button>
            </form>
        @else
            <button @click="showLogin = true; showRegister = false" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                 Login
            </button>
            <button @click="showRegister = true; showLogin = false" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                 Register
            </button>
        @endauth
    </div>
</nav>
@endif

@if (session('error'))
    <div class="bg-red-600 text-white px-4 py-2 text-center">
        {{ session('error') }}
    </div>
@endif

<!-- Modal Booking Berhasil -->
<div 
    x-data="{ show: {{ session('success_booking') ? 'true' : 'false' }} }"
    x-show="show"
    x-cloak
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
>
    <div 
        class="bg-gray-800 bg-opacity-90 text-white p-6 rounded-xl shadow-2xl w-full max-w-sm text-center relative"
        @click.outside="show = false"
    >
        <!-- Ikon sukses -->
        <div class="mx-auto w-14 h-14 rounded-full bg-green-700 bg-opacity-30 flex items-center justify-center mb-4">
            <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <!-- Judul dan pesan -->
        <h2 class="text-xl font-bold text-green-400 mb-1">Booking Berhasil!</h2>
        <p class="text-sm text-gray-300 mb-4">Terima kasih telah booking di Barbetro. Kami akan segera memproses jadwalmu.</p>

        <!-- Tombol tutup -->
        <button 
            @click="show = false"
            class="mt-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition"
        >
            Tutup
        </button>
    </div>
</div>


<!-- Konten -->
@yield('content')

<!-- Modal Login Prompt -->
<div x-show="showLoginPrompt" x-cloak x-transition 
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-gray-800 text-white p-6 rounded-lg w-full max-w-sm shadow-lg" @click.outside="showLoginPrompt = false">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Akses Jadwal</h2>
            <button @click="showLoginPrompt = false" class="text-gray-400 hover:text-white text-xl">&times;</button>
        </div>
        <p class="mb-4 text-sm text-gray-300"> Silakan login terlebih dahulu untuk melihat jadwal barbershop.</p>
        <div class="space-y-2">
            <button 
                @click="showLoginPrompt = false; showLogin = true" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition"
            >
                 Sudah punya akun? Login di sini
            </button>
            <button 
                @click="showLoginPrompt = false; showRegister = true" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition"
            >
                 Belum punya akun? Daftar sekarang
            </button>
        </div>
    </div>
</div>

<!-- Modal Login -->
<div x-show="showLogin" x-cloak x-transition 
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-gray-800 text-white p-6 rounded-lg w-full max-w-sm shadow-lg" @click.outside="showLogin = false">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Login</h2>
           <button @click="showLogin = false; $nextTick(() => document.querySelector('#loginErrors')?.remove())" class="text-gray-400 hover:text-white text-xl">&times;</button>
        </div>
        <div x-show="loginReason" class="mb-4 text-sm text-red-400">
            <template x-text="loginReason"></template>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" class="w-full mt-1 p-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400" placeholder="email@example.com" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" class="w-full mt-1 p-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400" placeholder="********" required>
            </div>
            <div class="flex justify-between items-center mt-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
                     Login
                </button>
                <button type="button" @click="showLogin = false; showRegister = true" class="text-sm text-gray-400 hover:text-white transition">
                    Belum punya akun?
                </button>
            </div>
@if ($errors->any())
    <div class="text-red-400 text-sm mb-4" x-show="showLogin">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

        </form>
    </div>
</div>

<!-- Modal Register -->
<div x-show="showRegister" x-cloak x-transition 
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-gray-800 text-white p-6 rounded-lg w-full max-w-sm shadow-lg" @click.outside="showRegister = false">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Register</h2>
            <button @click="showRegister = false; $nextTick(() => document.querySelector('#registerErrors')?.remove())" class="text-gray-400 hover:text-white text-xl">&times;</button>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300">Nama</label>
                <input type="text" name="username" class="w-full mt-1 p-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400" placeholder="Nama lengkap" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" class="w-full mt-1 p-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400" placeholder="email@example.com" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" name="password" class="w-full mt-1 p-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full mt-1 p-2 bg-gray-700 border border-gray-600 rounded text-white placeholder-gray-400" required>
            </div>
            <div class="flex justify-between items-center mt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                     Register
                </button>
                <button type="button" @click="showRegister = false; showLogin = true" class="text-sm text-gray-400 hover:text-white transition">
                    Sudah punya akun?
                </button>
            </div>
@if ($errors->any())
    <div class="text-red-400 text-sm mb-4" x-show="showRegister">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
        </form>
    </div>
</div>

    @stack('scripts')
    <script src="https://unpkg.com/alpinejs" defer></script>
</body>
</html>