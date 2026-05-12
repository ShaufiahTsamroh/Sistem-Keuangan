@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Data Pengeluaran</h1>

{{-- Notifikasi sukses --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Form pengajuan pengeluaran --}}
{{-- Bendahara mengisi form ini, lalu menunggu persetujuan Admin --}}
<div class="bg-white p-5 rounded-xl shadow mb-8">
    <h2 class="text-lg font-semibold mb-4">Ajukan Pengeluaran</h2>
    <form method="POST" action="/bendahara/pengeluaran">
        @csrf
        <input type="hidden" name="type" value="keluar">
        <div class="flex gap-4 flex-wrap">

            {{-- Jumlah pengeluaran --}}
            <input type="number" name="amount" placeholder="Jumlah" required
                class="border p-2 rounded w-40"/>

            {{-- Pilih kategori keluar --}}
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
                Ajukan
            </button>
        </div>
    </form>
</div>

{{-- Tabel daftar pengeluaran yang sudah diajukan --}}
<div class="bg-white p-5 rounded-xl shadow">
    <h2 class="text-lg font-semibold mb-4">Riwayat Pengajuan</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="py-2">No</th>
                <th class="py-2">Jumlah</th>
                <th class="py-2">Kategori</th>
                <th class="py-2">Tanggal</th>
                <th class="py-2">Keterangan</th>
                <th class="py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $d)
            <tr class="border-b">
                <td class="py-2">{{ $index + 1 }}</td>
                <td class="py-2">Rp {{ number_format($d->amount, 0, ',', '.') }}</td>
                <td class="py-2">{{ $d->category->name ?? '-' }}</td>
                <td class="py-2">{{ $d->date }}</td>
                <td class="py-2">{{ $d->description ?? '-' }}</td>
                <td class="py-2">
                    @if($d->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pending</span>
                    @elseif($d->status == 'selesai')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Disetujui</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Ditolak</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="py-4 text-center text-gray-400">Belum ada pengajuan pengeluaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection