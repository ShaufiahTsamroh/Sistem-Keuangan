@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Kelola Pemasukan</h1>

{{-- Notifikasi sukses --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Form tambah pemasukan --}}
<div class="bg-white p-5 rounded-xl shadow mb-8">
    <h2 class="text-lg font-semibold mb-4">Tambah Pemasukan</h2>
    <form method="POST" action="/admin/transaksi">
        @csrf
        {{-- Tipe disembunyikan dan otomatis masuk --}}
        <input type="hidden" name="type" value="masuk">
        <div class="flex gap-4 flex-wrap">

            {{-- Pilih user --}}
            <select name="user_id" required class="border p-2 rounded w-48">
                <option value="">Pilih User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            {{-- Jumlah --}}
            <input type="number" name="amount" placeholder="Jumlah" required
                class="border p-2 rounded w-40"/>

            {{-- Pilih kategori masuk --}}
            <select name="category_id" required class="border p-2 rounded w-48">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            {{-- Tanggal --}}
            <input type="date" name="date" required class="border p-2 rounded w-40"/>

            {{-- Keterangan --}}
            <input type="text" name="description" placeholder="Keterangan"
                class="border p-2 rounded w-48"/>

            <button type="submit"
                class="bg-[#7B2C2C] text-white px-4 py-2 rounded hover:bg-[#5a1f1f]">
                Tambah
            </button>
        </div>
    </form>
</div>

{{-- Tabel daftar pemasukan --}}
<div class="bg-white p-5 rounded-xl shadow">
    <h2 class="text-lg font-semibold mb-4">Daftar Pemasukan</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="py-2">No</th>
                <th class="py-2">User</th>
                <th class="py-2">Jumlah</th>
                <th class="py-2">Kategori</th>
                <th class="py-2">Tanggal</th>
                <th class="py-2">Keterangan</th>
                <th class="py-2">Status</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $transaction)
            <tr class="border-b">
                <td class="py-2">{{ $index + 1 }}</td>
                <td class="py-2">{{ $transaction->user->name ?? '-' }}</td>
                <td class="py-2">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                <td class="py-2">{{ $transaction->category->name ?? '-' }}</td>
                <td class="py-2">{{ $transaction->date }}</td>
                <td class="py-2">{{ $transaction->description ?? '-' }}</td>

                {{-- Badge status --}}
                <td class="py-2">
                    @if($transaction->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pending</span>
                    @elseif($transaction->status == 'selesai')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Selesai</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Ditolak</span>
                    @endif
                </td>

                <td class="py-2 flex gap-2">
                    {{-- Tombol approve hanya muncul kalau statusnya pending --}}
                    @if($transaction->status == 'pending')
                        <form method="POST" action="/admin/transaksi/{{ $transaction->id }}/approve">
                            @csrf @method('PATCH')
                            <button type="submit"
                                class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">
                                Setujui
                            </button>
                        </form>
                        <form method="POST" action="/admin/transaksi/{{ $transaction->id }}/reject">
                            @csrf @method('PATCH')
                            <button type="submit"
                                class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600">
                                Tolak
                            </button>
                        </form>
                    @endif

                    {{-- Tombol hapus selalu ada --}}
                    <form method="POST" action="/admin/transaksi/{{ $transaction->id }}">
                        @csrf @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                            class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection