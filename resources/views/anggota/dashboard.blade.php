@extends('layouts.anggota')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

<div class="flex gap-6 mb-8">

    {{-- Kartu Total Saldo --}}
    <div class="bg-white p-5 rounded-xl shadow w-56">
        <p class="text-sm text-gray-500 font-medium">Total Saldo</p>
        <h2 class="text-xl font-bold mt-1">Rp {{ number_format($saldo, 0, ',', '.') }}</h2>
    </div>

    {{-- Kartu Total Pemasukan --}}
    <div class="bg-white p-5 rounded-xl shadow w-56">
        <p class="text-sm text-gray-500 font-medium">Total Pemasukan</p>
        <h2 class="text-xl font-bold mt-1">Rp {{ number_format($pemasukan, 0, ',', '.') }}</h2>
    </div>

    {{-- Kartu Total Pengeluaran --}}
    <div class="bg-white p-5 rounded-xl shadow w-56">
        <p class="text-sm text-gray-500 font-medium">Total Pengeluaran</p>
        <h2 class="text-xl font-bold mt-1">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h2>
    </div>

</div>

{{-- Informasi bahwa anggota hanya bisa melihat data --}}
<div class="bg-white p-5 rounded-xl shadow">
    <p class="text-sm text-gray-500">Kamu login sebagai <b>Anggota</b>. Kamu hanya bisa melihat data keuangan organisasi.</p>
</div>

@endsection