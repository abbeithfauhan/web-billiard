@extends('layouts.admin')
@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Pendaftar: {{ $tournament->name }}</h2>
        <a href="{{ route('admin.tournaments.index') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:underline">← Kembali</a>
    </div>
@endsection
@section('content')
    @if(session('success'))<div class="bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700 p-4 mb-6 rounded-md" role="alert"><p>{{ session('success') }}</p></div>@endif
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Nama Pendaftar</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Status</th>
                        <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($registrations as $registration)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900 dark:text-gray-100">{{ $registration->user->name }}</div>
                            <div class="text-gray-500">{{ $registration->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($registration->status == 'confirmed') <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Terkonfirmasi</span>
                            @elseif($registration->status == 'cancelled') <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Ditolak</span>
                            @else <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-2">
                            @if($registration->status == 'pending')
                                <form action="{{ route('admin.registrations.confirm', $registration) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="font-semibold text-emerald-600 hover:underline">Konfirmasi</button>
                                </form>
                                <form action="{{ route('admin.registrations.cancel', $registration) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Tolak</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-6">Belum ada pendaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection