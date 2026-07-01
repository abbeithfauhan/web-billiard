@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Manajemen Meja Billiard</h2>
        <a href="{{ route('admin.tables.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold hover:bg-indigo-700">Tambah Meja Baru</a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Harga/Jam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($tables as $table)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $table->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $table->type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($table->price_per_hour) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($table->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.tables.edit', $table) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                                <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Anda yakin ingin menghapus meja ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-4">Belum ada data meja.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $tables->links() }}</div>
        </div>
    </div>
@endsection