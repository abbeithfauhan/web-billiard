@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Semua Riwayat Booking</h2>
@endsection

@section('content')
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl">
        <div class="p-6">
            @if(session('success'))
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-4" role="alert"><p>{{ session('success') }}</p></div>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">User</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">Meja</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">Waktu Mulai</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-600 uppercase">Status</th>
                            <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-200">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $booking->billiardTable->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $booking->start_time }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">
                                @if($booking->status == 'confirmed') <span class="text-emerald-600">{{ ucfirst($booking->status) }}</span>
                                @elseif($booking->status == 'cancelled') <span class="text-red-600">{{ ucfirst($booking->status) }}</span>
                                @elseif($booking->status == 'pending') <span class="text-amber-600">{{ ucfirst($booking->status) }}</span>
                                @else <span class="text-gray-600">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right font-medium space-x-4">
                                <a href="{{ route('admin.bookings.edit', $booking) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-gray-500 py-6">Belum ada data booking.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             @if ($bookings->hasPages())<div class="p-4">{{ $bookings->links() }}</div>@endif
        </div>
    </div>
@endsection