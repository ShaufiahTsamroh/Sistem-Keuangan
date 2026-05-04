@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Data Transaksi</h1>

<div class="bg-white p-5 rounded-xl shadow">
    <table class="w-full text-left border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">User</th>
                <th class="p-2">Tipe</th>
                <th class="p-2">Jumlah</th>
                <th class="p-2">Keterangan</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr class="border-t">
                <td class="p-2">{{ $d->user_id }}</td>
                <td class="p-2">{{ $d->type }}</td>
                <td class="p-2">{{ $d->amount }}</td>
                <td class="p-2">{{ $d->description }}</td>
                <td class="p-2">{{ $d->date }}</td>
                <td class="p-2">{{ $d->category->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection