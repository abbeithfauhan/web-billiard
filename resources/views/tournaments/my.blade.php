<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Riwayat Pendaftaran Turnamen Saya</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Nama Turnamen</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Tanggal Mulai</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Status Pendaftaran</th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Status Turnamen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            {{-- KOREKSI: Gunakan $my_registrations as $reg --}}
                            @forelse($my_registrations as $reg)
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $hasStarted = $now->isAfter($reg->tournament->start_date);
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">{{ $reg->tournament->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">{{ $reg->tournament->start_date->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($reg->status == 'confirmed')
                                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Terkonfirmasi</span>
                                        @elseif($reg->status == 'cancelled')
                                            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Ditolak</span>
                                        @else
                                            <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">
                                        @if($hasStarted)
                                            <span class="text-gray-500">Selesai/Berlangsung</span>
                                        @else
                                            <span class="text-cyan-600">Belum Dimulai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-gray-500 py-6">Anda belum mendaftar di turnamen mana pun.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>