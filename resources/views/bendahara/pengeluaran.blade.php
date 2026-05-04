@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Data Pengeluaran</h1>

<div class="bg-white p-5 rounded-xl shadow">
    <table class="w-full text-left border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">User</th>
                <th class="p-2 border">Jumlah</th>
                <th class="p-2 border">Keterangan</th>
                <th class="p-2 border">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td class="p-2 border">{{ $d->user_id }}</td>
                <td class="p-2 border">{{ $d->amount }}</td>
                <td class="p-2 border">{{ $d->description }}</td>
                <td class="p-2 border">{{ $d->date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection