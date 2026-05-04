@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Manajemen User</h1>

{{-- Notifikasi sukses --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Form tambah user baru --}}
<div class="bg-white p-5 rounded-xl shadow mb-8">
    <h2 class="text-lg font-semibold mb-4">Tambah User Baru</h2>
    <form method="POST" action="/admin/users">
        @csrf
        <div class="flex gap-4 flex-wrap">
            <input type="text" name="name" placeholder="Nama" required
                class="border p-2 rounded w-48"/>
            <input type="email" name="email" placeholder="Email" required
                class="border p-2 rounded w-48"/>
            <select name="role_id" required class="border p-2 rounded w-48">
                <option value="">Pilih Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
            <button type="submit"
                class="bg-[#7B2C2C] text-white px-4 py-2 rounded hover:bg-[#5a1f1f]">
                Tambah
            </button>
        </div>
    </form>
</div>

{{-- Tabel daftar user --}}
<div class="bg-white p-5 rounded-xl shadow">
    <h2 class="text-lg font-semibold mb-4">Daftar User</h2>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="py-2">Nama</th>
                <th class="py-2">Email</th>
                <th class="py-2">Role</th>
                <th class="py-2">Status</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b">
                <td class="py-2">{{ $user->name }}</td>
                <td class="py-2">{{ $user->email }}</td>

                {{-- Ubah role --}}
                <td class="py-2">
                    <form method="POST" action="/admin/users/{{ $user->id }}/role">
                        @csrf @method('PATCH')
                        <select name="role_id" onchange="this.form.submit()"
                            class="border p-1 rounded text-sm">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </td>

                {{-- Status aktif --}}
                <td class="py-2">
                    @if($user->is_active)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Aktif</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Nonaktif</span>
                    @endif
                </td>

                {{-- Tombol nonaktifkan/aktifkan --}}
                <td class="py-2">
                    <form method="POST" action="/admin/users/{{ $user->id }}/toggle">
                        @csrf @method('PATCH')
                        <button type="submit"
                            class="{{ $user->is_active ? 'bg-red-500' : 'bg-green-500' }} text-white px-3 py-1 rounded text-xs">
                            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection