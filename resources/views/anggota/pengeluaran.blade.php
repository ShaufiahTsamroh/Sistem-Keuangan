@extends('layouts.anggota')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Daftar Pengeluaran</h1>

<div class="bg-white p-5 rounded-xl shadow">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="py-2">No</th>
                <th class="py-2">Jumlah</th>
                <th class="py-2">Kategori</th>
                <th class="py-2">Tanggal</th>
                <th class="py-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $transaction)
            <tr class="border-b">
                <td class="py-2">{{ $index + 1 }}</td>
                <td class="py-2">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                <td class="py-2">{{ $transaction->category->name ?? '-' }}</td>
                <td class="py-2">{{ $transaction->date }}</td>
                <td class="py-2">{{ $transaction->description ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-4 text-center text-gray-400">Belum ada pengeluaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection