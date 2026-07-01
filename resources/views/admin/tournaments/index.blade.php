@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Manajemen Turnamen</h2>
        <x-primary-button-link href="{{ route('admin.tournaments.create') }}">Tambah Turnamen Baru</x-primary-button-link>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700 p-4 mb-6 rounded-md" role="alert"><p>{{ session('success') }}</p></div>
    @endif
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Nama Turnamen</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Jadwal Mulai</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Pendaftaran</th>
                        <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($tournaments as $tournament)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ $tournament->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $tournament->start_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $tournament->registration_open_date->format('d M') }} - {{ $tournament->registration_deadline->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-4">
                            <a href="{{ route('admin.tournaments.registrations', $tournament) }}" class="text-cyan-600 hover:text-cyan-900">Pendaftar</a>
                            <a href="{{ route('admin.tournaments.edit', $tournament) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.tournaments.destroy', $tournament) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-gray-500 py-6">Belum ada data turnamen.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($tournaments->hasPages())
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">{{ $tournaments->links() }}</div>
        @endif
    </div>
@endsection