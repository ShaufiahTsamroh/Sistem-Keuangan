<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 antialiased">

    <!-- NAVBAR BREEZE -->
    @include('layouts.navigation')

    <div class="flex">

        <!-- SIDEBAR -->
        <div class="w-64 min-h-screen bg-[#7B2C2C] text-white p-5 flex flex-col justify-between">

            <div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold">{{ Auth::user()->name }}</h3>
                    <span class="text-xs bg-blue-500 px-2 py-1 rounded-full">
                        Bendahara
                    </span>
                </div>

                <hr class="mb-6 border-gray-400">

                <ul class="space-y-3">
                    <li><a href="/bendahara/dashboard" class="block hover:bg-white/20 p-2 rounded">Dashboard</a></li>
                    <li><a href="/bendahara/transaksi" class="block hover:bg-white/20 p-2 rounded">Transaksi</a></li>
                    <li><a href="/bendahara/pemasukan" class="block hover:bg-white/20 p-2 rounded">Pemasukan</a></li>
                    <li><a href="/bendahara/pengeluaran" class="block hover:bg-white/20 p-2 rounded">Pengeluaran</a></li>
                    <li><a href="/bendahara/kategori" class="block hover:bg-white/20 p-2 rounded">Kategori</a></li>
                </ul>
            </div>

            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left hover:bg-white/20 p-2 rounded">
                        Keluar
                    </button>
                </form>
            </div>

        </div>

        <!-- CONTENT -->
        <div class="flex-1 bg-[#f5f1e8] p-8">

            <!-- SUPPORT BREEZE -->
            @isset($header)
                <div class="mb-6">
                    {{ $header }}
                </div>
            @endisset

            {{ $slot ?? '' }}
            @yield('content')

        </div>

    </div>

</body>
</html>