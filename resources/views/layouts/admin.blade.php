<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-gray-800 fixed left-0 top-0 flex flex-col justify-between">
        <div>
            <div class="flex items-center space-x-3 p-6 border-b border-gray-700">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-10 h-10 rounded-full">
                <span class="text-xl font-bold">Barbetro</span>
            </div>
            <nav class="flex flex-col mt-4 space-y-2 px-6">
                </a>
                <a href="{{ route('admin.customers') }}" class="hover:text-indigo-400 {{ request()->routeIs('admin.customers') ? 'text-indigo-400 font-semibold' : '' }}">
                    Data Pelanggan
                </a>
                <a href="{{ route('admin.revenue') }}" class="hover:text-indigo-400 {{ request()->routeIs('admin.revenue') ? 'text-indigo-400 font-semibold' : '' }}">
                    Pendapatan
                </a>
            </nav>
        </div>
        <div class="p-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-lg">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 w-full p-6">
        <h1 class="text-3xl font-bold mb-6">@yield('title')</h1>
        @yield('content')
    </main>

</body>
</html>
