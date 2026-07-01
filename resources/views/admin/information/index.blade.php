@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Manajemen Konten</h2>
        <a href="{{ route('admin.information.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold hover:bg-indigo-700">Tambah Konten Baru</a>
    </div>
@endsection

@section('content')
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert"><p>{{ session('success') }}</p></div>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Dibuat Pada</th>
                            <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                       @forelse($informations as $information)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ $information->title }}</td>
                            {{-- Tidak perlu lagi kolom Tipe untuk halaman informasi --}}
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $information->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-4">
                                <a href="{{ route('admin.information.edit', $information) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.information.destroy', $information) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-gray-500 py-6">Belum ada data informasi.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $informations->links() }}</div>
        </div>
    </div>
@endsection