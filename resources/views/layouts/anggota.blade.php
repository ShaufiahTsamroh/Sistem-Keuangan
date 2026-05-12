<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anggota - OrgFinance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 antialiased">

{{-- Navbar bawaan Laravel Breeze --}}
@include('layouts.navigation')

<div class="flex">

    {{-- SIDEBAR ANGGOTA --}}
    <div class="w-64 min-h-screen bg-[#7B2C2C] text-white p-5 flex flex-col justify-between">

        <div>
            {{-- Nama dan badge role --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold">{{ Auth::user()->name }}</h3>
                {{-- Badge khusus Anggota --}}
                <span class="text-xs bg-red-900 px-2 py-1 rounded-full">
                    Anggota
                </span>
            </div>

            <hr class="mb-6 border-gray-400">

            {{-- Menu Anggota — hanya bisa lihat data --}}
            <ul class="space-y-3">
                <li><a href="/anggota/dashboard" class="block hover:bg-white/20 p-2 rounded">Dashboard</a></li>
                <li><a href="/anggota/transaksi" class="block hover:bg-white/20 p-2 rounded">Transaksi</a></li>
                <li><a href="/anggota/pemasukan" class="block hover:bg-white/20 p-2 rounded">Pemasukan</a></li>
                <li><a href="/anggota/pengeluaran" class="block hover:bg-white/20 p-2 rounded">Pengeluaran</a></li>
            </ul>
        </div>

        {{-- Tombol Keluar --}}
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left hover:bg-white/20 p-2 rounded">
                    Keluar
                </button>
            </form>
        </div>

    </div>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 bg-[#f5f1e8] p-8">
        @yield('content')
    </div>

</div>

</body>
</html>