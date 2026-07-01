<x-app-layout>
    <div class="gradient-billiard min-h-screen py-12 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Banner Premium -->
            <div class="card-premium p-8 md:p-12 mb-12">
                <div class="space-y-2">
                    <h1 class="text-4xl md:text-5xl font-bold font-heading gradient-text-primary">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-lg text-slate-400 leading-relaxed">
                        Selamat datang di {{ config('app.name') }}, platform booking meja billiard terbaik. Siap untuk bermain dan menunjukkan skill-mu?
                    </p>
                </div>

                <!-- Stats Bar -->
                <div class="grid grid-cols-3 gap-4 mt-8 pt-8 border-t border-cyan-400/20">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-cyan-400">12</div>
                        <div class="text-sm text-slate-400 mt-1">Booking Tercatat</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-cyan-400">5</div>
                        <div class="text-sm text-slate-400 mt-1">Turnamen Diikuti</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-cyan-400">#18</div>
                        <div class="text-sm text-slate-400 mt-1">Ranking Anda</div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <!-- Card 1: Booking Meja -->
                <a href="{{ route('booking.create') }}" class="group card-premium p-8 hover:border-cyan-400/80">
                    <div class="space-y-4">
                        <div class="inline-block p-4 rounded-xl bg-gradient-cyan-blue/20 group-hover:scale-110 transition-transform">
                            <svg class="h-8 w-8 text-cyan-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0h18M12 12.75h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white group-hover:text-cyan-400 transition-colors">Booking Meja</h3>
                            <p class="mt-2 text-slate-400">Lihat ketersediaan meja dan pesan favorit Anda sekarang.</p>
                        </div>
                        <div class="pt-4 flex items-center text-cyan-400 text-sm font-semibold group-hover:translate-x-2 transition-transform">
                            Mulai Booking <span class="ml-2">→</span>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Riwayat Booking -->
                <a href="{{ route('booking.history') }}" class="group card-premium p-8 hover:border-cyan-400/80">
                    <div class="space-y-4">
                        <div class="inline-block p-4 rounded-xl bg-gradient-to-br from-emerald-500/20 to-cyan-500/20 group-hover:scale-110 transition-transform">
                            <svg class="h-8 w-8 text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white group-hover:text-emerald-400 transition-colors">Riwayat Booking</h3>
                            <p class="mt-2 text-slate-400">Lihat semua pesanan meja Anda yang telah berlalu.</p>
                        </div>
                        <div class="pt-4 flex items-center text-emerald-400 text-sm font-semibold group-hover:translate-x-2 transition-transform">
                            Lihat Riwayat <span class="ml-2">→</span>
                        </div>
                    </div>
                </a>

                <!-- Card 3: Turnamen & Info -->
                <a href="{{ route('tournaments.index') }}" class="group card-premium p-8 hover:border-cyan-400/80">
                    <div class="space-y-4">
                        <div class="inline-block p-4 rounded-xl bg-gradient-to-br from-amber-500/20 to-orange-500/20 group-hover:scale-110 transition-transform">
                            <svg class="h-8 w-8 text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-6.75c-.621 0-1.125.504-1.125 1.125V18.75m9 0h-9" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white group-hover:text-amber-400 transition-colors">Turnamen & Event</h3>
                            <p class="mt-2 text-slate-400">Ikuti turnamen seru dan dapatkan hadiah menarik.</p>
                        </div>
                        <div class="pt-4 flex items-center text-amber-400 text-sm font-semibold group-hover:translate-x-2 transition-transform">
                            Jelajahi <span class="ml-2">→</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Additional Features Grid -->
            <div class="grid grid-cols-1 gap-6">
                <!-- Recent Activity Card -->
                <div class="card-premium p-8">
                    <h3 class="text-2xl font-bold text-white mb-6">Aktivitas Terbaru</h3>
                    <div class="space-y-3">
                        @forelse($recentActivities as $activity)
                            <div class="flex items-center gap-3 p-3 bg-slate-800/50 rounded-lg hover:bg-slate-800/70 transition-colors group">
                                <div class="text-lg flex-shrink-0">{{ $activity->getActivityIcon() }}</div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-white group-hover:text-cyan-400 transition-colors font-medium">{{ $activity->title }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5 line-clamp-1">{{ $activity->description }}</p>
                                </div>
                                <span class="text-xs text-slate-500 flex-shrink-0">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400">
                                Belum ada aktivitas terekam
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
