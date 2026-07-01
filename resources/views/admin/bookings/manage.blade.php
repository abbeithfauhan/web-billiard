@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Kelola Booking (Pending)</h2>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Meja</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Waktu Booking</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($pendingBookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->billiardTable->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->start_time->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="font-semibold text-green-600 dark:text-green-400 hover:underline">Confirm</button>
                                </form>
                                <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="font-semibold text-red-600 dark:text-red-400 hover:underline">Cancel</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-4">Tidak ada booking yang perlu dikelola.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $pendingBookings->links() }}</div>
        </div>
    </div>
@endsection