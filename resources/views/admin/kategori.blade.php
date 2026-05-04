@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Kelola Kategori</h1>

{{-- Notifikasi sukses --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Form tambah kategori baru --}}
<div class="bg-white p-5 rounded-xl shadow mb-8">
    <h2 class="text-lg font-semibold mb-4">Tambah Kategori Baru</h2>
    <form method="POST" action="/admin/kategori">
        @csrf
        <div class="flex gap-4 flex-wrap">
            {{-- Input nama kategori --}}
            <input type="text" name="name" placeholder="Nama Kategori" required
                class="border p-2 rounded w-48"/>

            {{-- Pilih tipe: masuk atau keluar --}}
            <select name="type" required class="border p-2 rounded w-48">
                <option value="">Pilih Tipe</option>
                <option value="masuk">Masuk</option>
                <option value="keluar">Keluar</option>
            </select>

            <button type="submit"
                class="bg-[#7B2C2C] text-white px-4 py-2 rounded hover:bg-[#5a1f1f]">
                Tambah
            </button>
        </div>
    </form>
</div>

{{-- Tabel daftar kategori --}}
<div class="bg-white p-5 rounded-xl shadow">
    <h2 class="text-lg font-semibold mb-4">Daftar Kategori</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="py-2">No</th>
                <th class="py-2">Nama</th>
                <th class="py-2">Tipe</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $category)
            <tr class="border-b">
                <td class="py-2">{{ $index + 1 }}</td>
                <td class="py-2">{{ $category->name }}</td>
                <td class="py-2">
                    {{-- Badge warna berbeda untuk masuk dan keluar --}}
                    @if($category->type == 'masuk')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Masuk</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Keluar</span>
                    @endif
                </td>
                <td class="py-2 flex gap-2">

                    {{-- Form edit kategori --}}
                    <form method="POST" action="/admin/kategori/{{ $category->id }}" class="flex gap-2 items-center">
                        @csrf @method('PATCH')
                        <input type="text" name="name" value="{{ $category->name }}"
                            class="border p-1 rounded text-sm w-32"/>
                        <select name="type" class="border p-1 rounded text-sm">
                            <option value="masuk" {{ $category->type == 'masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="keluar" {{ $category->type == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                        <button type="submit"
                            class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                            Simpan
                        </button>
                    </form>

                    {{-- Form hapus kategori --}}
                    <form method="POST" action="/admin/kategori/{{ $category->id }}">
                        @csrf @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Yakin ingin menghapus kategori ini?')"
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