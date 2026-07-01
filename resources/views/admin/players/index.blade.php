<x-app-layout>
    <div class="gradient-billiard min-h-screen py-12 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="card-premium p-8 mb-8">
                <h1 class="text-4xl font-bold font-heading gradient-text-primary mb-2">Manajemen Data Pemain</h1>
                <p class="text-slate-400">Edit dan kelola data peringkat, statistik, dan informasi pemain top</p>
            </div>

            @if (session('success'))
                <div class="card-premium border-l-4 border-emerald-400 p-6 mb-6">
                    <p class="text-emerald-300">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Players Table -->
            <div class="card-premium overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-cyan-400/20">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-cyan-400">Ranking</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-cyan-400">Nama Pemain</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-cyan-400">Email</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-cyan-400">Menang</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-cyan-400">Kalah</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-cyan-400">Poin</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-cyan-400">Tournament</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-cyan-400">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($players as $player)
                                <tr class="border-b border-slate-700/50 hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-3 py-1 rounded-full bg-gradient-cyan-blue text-white font-bold text-sm">
                                            #{{ $player->ranking }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-white">{{ $player->user->name }}</div>
                                        <div class="text-xs text-slate-400">Booking: {{ $player->total_bookings }}x</div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-400">{{ $player->user->email }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block px-3 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 font-semibold">
                                            {{ $player->wins }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block px-3 py-1 rounded-lg bg-red-500/20 text-red-300 font-semibold">
                                            {{ $player->losses }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block px-3 py-1 rounded-lg bg-cyan-500/20 text-cyan-300 font-bold">
                                            {{ $player->points }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-300">
                                        {{ $player->tournaments_participated }}
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('admin.players.edit', $player->id) }}" class="btn-primary text-xs px-3 py-1">
                                            Edit
                                        </a>
                                        <a href="{{ route('admin.players.show', $player->id) }}" class="btn-secondary text-xs px-3 py-1">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-slate-400">
                                        Belum ada data pemain
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-slate-700/50">
                    {{ $players->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
