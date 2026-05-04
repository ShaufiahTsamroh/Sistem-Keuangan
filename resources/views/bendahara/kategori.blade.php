@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Data Kategori</h1>

<div class="bg-white p-5 rounded-xl shadow">

    <table class="w-full text-left border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Tipe</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $d)
            <tr class="border-t">
                <td class="p-2 border">{{ $d->id }}</td>
                <td class="p-2 border">{{ $d->name }}</td>
                <td class="p-2 border">
                    <span class="px-2 py-1 rounded text-white 
                        {{ $d->type == 'masuk' ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ $d->type }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection