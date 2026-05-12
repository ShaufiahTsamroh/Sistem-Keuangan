@extends('layouts.anggota')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Daftar Transaksi</h1>

<div class="bg-white p-5 rounded-xl shadow">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="py-2">No</th>
                <th class="py-2">Tipe</th>
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
                <td class="py-2">
                    @if($transaction->type == 'masuk')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Masuk</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Keluar</span>
                    @endif
                </td>
                <td class="py-2">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                <td class="py-2">{{ $transaction->category->name ?? '-' }}</td>
                <td class="py-2">{{ $transaction->date }}</td>
                <td class="py-2">{{ $transaction->description ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="py-4 text-center text-gray-400">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection