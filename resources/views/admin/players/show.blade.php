<x-app-layout>
    <div class="gradient-billiard min-h-screen py-12 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="card-premium p-8 mb-8">
                <a href="{{ route('admin.players.index') }}" class="text-cyan-400 hover:text-cyan-300 mb-4 inline-block">
                    ← Kembali ke Daftar Pemain
                </a>
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold font-heading text-white mb-2">{{ $userStats->user->name }}</h1>
                        <p class="text-slate-400">{{ $userStats->user->email }}</p>
                    </div>
                    <a href="{{ route('admin.players.edit', $userStats->id) }}" class="btn-primary">
                        Edit Data
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="card-premium p-6 text-center">
                    <div class="text-sm text-slate-400 mb-2">Peringkat</div>
                    <div class="text-4xl font-bold gradient-text-primary">#{{ $userStats->ranking }}</div>
                </div>

                <div class="card-premium p-6 text-center">
                    <div class="text-sm text-slate-400 mb-2">Total Poin</div>
                    <div class="text-4xl font-bold text-cyan-400">{{ $userStats->points }}</div>
                </div>

                <div class="card-premium p-6 text-center">
                    <div class="text-sm text-slate-400 mb-2">Win Rate</div>
                    <div class="text-4xl font-bold text-emerald-400">{{ $userStats->win_rate }}%</div>
                </div>

                <div class="card-premium p-6 text-center">
                    <div class="text-sm text-slate-400 mb-2">Jam Main</div>
                    <div class="text-4xl font-bold text-amber-400">{{ $userStats->total_hours_played }}</div>
                </div>
            </div>

            <!-- Detailed Stats -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <!-- Match Stats -->
                <div class="card-premium p-8">
                    <h3 class="text-xl font-bold text-cyan-400 mb-6">Statistik Pertandingan</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-slate-700/50">
                            <span class="text-slate-300">Kemenangan</span>
                            <span class="text-2xl font-bold text-emerald-400">{{ $userStats->wins }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-slate-700/50">
                            <span class="text-slate-300">Kekalahan</span>
                            <span class="text-2xl font-bold text-red-400">{{ $userStats->losses }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-slate-700/50">
                            <span class="text-slate-300">Seri</span>
                            <span class="text-2xl font-bold text-slate-400">{{ $userStats->draws }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-slate-700/50">
                            <span class="text-slate-300 font-semibold">Total</span>
                            <span class="text-2xl font-bold text-cyan-400">{{ $userStats->wins + $userStats->losses + $userStats->draws }}</span>
                        </div>
                    </div>
                </div>

                <!-- Activity Stats -->
                <div class="card-premium p-8">
                    <h3 class="text-xl font-bold text-cyan-400 mb-6">Statistik Aktivitas</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-slate-700/50">
                            <span class="text-slate-300">Total Booking</span>
                            <span class="text-2xl font-bold text-cyan-400">{{ $userStats->total_bookings }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-slate-700/50">
                            <span class="text-slate-300">Tournament Diikuti</span>
                            <span class="text-2xl font-bold text-amber-400">{{ $userStats->tournaments_participated }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-slate-700/50">
                            <span class="text-slate-300">Jam Main</span>
                            <span class="text-2xl font-bold text-blue-400">{{ $userStats->total_hours_played }}h</span>
                        </div>
                        <div class="flex justify-between items-center pt-3 border-t border-slate-700/50">
                            <span class="text-slate-300 font-semibold">Poin/Jam</span>
                            <span class="text-2xl font-bold text-cyan-400">
                                {{ $userStats->total_hours_played > 0 ? round($userStats->points / $userStats->total_hours_played) : 0 }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Performance -->
                <div class="card-premium p-8">
                    <h3 class="text-xl font-bold text-cyan-400 mb-6">Performa</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-slate-300">Win Rate</span>
                                <span class="font-bold text-cyan-400">{{ $userStats->win_rate }}%</span>
                            </div>
                            <div class="w-full bg-slate-800 rounded-full h-2">
                                <div class="bg-gradient-cyan-blue h-2 rounded-full" style="width: {{ $userStats->win_rate }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-slate-300">Konsistensi</span>
                                <span class="font-bold text-blue-400">
                                    {{ round((($userStats->wins + $userStats->losses + $userStats->draws) / max($userStats->total_bookings, 1)) * 100, 1) }}%
                                </span>
                            </div>
                            <div class="w-full bg-slate-800 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-400 to-cyan-400 h-2 rounded-full" 
                                     style="width: {{ round((($userStats->wins + $userStats->losses + $userStats->draws) / max($userStats->total_bookings, 1)) * 100, 1) }}%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-slate-300">Engagement</span>
                                <span class="font-bold text-amber-400">
                                    {{ round(($userStats->total_bookings + $userStats->tournaments_participated) / 2) }}x/bulan
                                </span>
                            </div>
                            <div class="w-full bg-slate-800 rounded-full h-2">
                                <div class="bg-gradient-to-r from-amber-400 to-orange-400 h-2 rounded-full" 
                                     style="width: {{ min(round(($userStats->total_bookings + $userStats->tournaments_participated) / 2), 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="card-premium p-8">
                <h3 class="text-2xl font-bold text-cyan-400 mb-6">Aktivitas Terakhir</h3>
                
                @if ($recentActivities->count() > 0)
                    <div class="space-y-4">
                        @foreach ($recentActivities as $activity)
                            <div class="flex items-start gap-4 p-4 bg-slate-800/50 rounded-lg hover:bg-slate-800/70 transition-colors">
                                <div class="text-3xl flex-shrink-0">{{ $activity->getActivityIcon() }}</div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-white">{{ $activity->title }}</h4>
                                    <p class="text-sm text-slate-400 mt-1">{{ $activity->description }}</p>
                                    <p class="text-xs text-slate-500 mt-2">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="badge-cyan">{{ ucfirst($activity->type) }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-slate-400">
                        Belum ada aktivitas terekam
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
