<x-app-layout>
    <x-slot name="title">Riwayat Booking - {{ config('app.name') }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Riwayat Booking Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-800/50 border-l-4 border-green-500 dark:border-green-400 text-green-700 dark:text-green-200 p-4 mb-6 rounded-md" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Meja</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Waktu Mulai</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Waktu Selesai</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ $booking->billiardTable->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $booking->start_time->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $booking->end_time->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($booking->status == 'confirmed')
                                            <span class="inline-flex items-center rounded-md bg-green-50 dark:bg-green-500/10 px-2 py-1 text-xs font-medium text-green-700 dark:text-green-400 ring-1 ring-inset ring-green-600/20 dark:ring-green-500/20">Terkonfirmasi</span>
                                        @elseif($booking->status == 'cancelled')
                                            <span class="inline-flex items-center rounded-md bg-red-50 dark:bg-red-500/10 px-2 py-1 text-xs font-medium text-red-700 dark:text-red-400 ring-1 ring-inset ring-red-600/20 dark:ring-red-500/20">Dibatalkan</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="inline-flex items-center rounded-md bg-yellow-50 dark:bg-yellow-400/10 px-2 py-1 text-xs font-medium text-yellow-800 dark:text-yellow-500 ring-1 ring-inset ring-yellow-600/20 dark:ring-yellow-400/20">Menunggu Konfirmasi</span>
                                        @else
                                            <span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-400/10 px-2 py-1 text-xs font-medium text-gray-600 dark:text-gray-300 ring-1 ring-inset ring-gray-500/10 dark:ring-gray-400/20">{{ ucfirst($booking->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                        Anda belum pernah melakukan booking.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($bookings->hasPages())
                    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </x-app-layout>
    ```
