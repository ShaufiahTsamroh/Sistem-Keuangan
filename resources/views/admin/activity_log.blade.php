@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-semibold mb-6">Activity Log</h1>

<div class="bg-white p-5 rounded-xl shadow">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left border-b">
                <th class="py-2">No</th>
                <th class="py-2">User</th>
                <th class="py-2">Aktivitas</th>
                <th class="py-2">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $index => $log)
            <tr class="border-b">
                <td class="py-2">{{ $index + 1 }}</td>
                <td class="py-2">{{ $log->user->name ?? '-' }}</td>
                <td class="py-2">{{ $log->activity }}</td>
                <td class="py-2">{{ $log->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-4 text-center text-gray-400">
                    Belum ada aktivitas tercatat
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection