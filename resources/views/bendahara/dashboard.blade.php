@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

<div class="flex gap-6">

    <div class="bg-white p-5 rounded-xl shadow w-56">
        <p class="text-sm text-gray-500 font-bold mt-1">Total Saldo</p>
        <h2 class="text-xl font-bold mt-1">Rp {{ $saldo }}</h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow w-56">
        <p class="text-sm text-gray-500 font-bold mt-1">Total Pemasukan</p>
        <h2 class="text-xl font-bold mt-1">Rp {{ $pemasukan }}</h2>
    </div>

    <div class="bg-white p-5 rounded-xl shadow w-56">
        <p class="text-sm text-gray-500 font-bold mt-1">Total Pengeluaran</p>
        <h2 class="text-xl font-bold mt-1">Rp {{ $pengeluaran }}</h2>
    </div>

</div>

@endsection