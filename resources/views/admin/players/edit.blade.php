<x-app-layout>
    <div class="gradient-billiard min-h-screen py-12 px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="card-premium p-8 mb-8">
                <a href="{{ route('admin.players.index') }}" class="text-cyan-400 hover:text-cyan-300 mb-4 inline-block">
                    ← Kembali ke Daftar Pemain
                </a>
                <h1 class="text-3xl font-bold font-heading text-white">Edit Data Pemain</h1>
                <p class="text-slate-400 mt-2">{{ $userStats->user->name }}</p>
            </div>

            <!-- Edit Form -->
            <form action="{{ route('admin.players.update', $userStats->id) }}" method="POST" class="card-premium p-8">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Statistik Pertandingan -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-cyan-400 mb-4">Statistik Pertandingan</h3>

                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Kemenangan</label>
                            <input type="number" name="wins" value="{{ $userStats->wins }}" 
                                   class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-cyan-400 focus:outline-none"
                                   required>
                            @error('wins')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Kekalahan</label>
                            <input type="number" name="losses" value="{{ $userStats->losses }}" 
                                   class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-cyan-400 focus:outline-none"
                                   required>
                            @error('losses')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Seri</label>
                            <input type="number" name="draws" value="{{ $userStats->draws }}" 
                                   class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-cyan-400 focus:outline-none"
                                   required>
                            @error('draws')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Poin dan Ranking -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-cyan-400 mb-4">Poin dan Ranking</h3>

                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Total Poin</label>
                            <input type="number" name="points" value="{{ $userStats->points }}" 
                                   class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-cyan-400 focus:outline-none"
                                   required>
                            @error('points')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Peringkat</label>
                            <input type="number" name="ranking" value="{{ $userStats->ranking }}" 
                                   class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-cyan-400 focus:outline-none"
                                   required>
                            @error('ranking')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Tournament Diikuti</label>
                            <input type="number" name="tournaments_participated" value="{{ $userStats->tournaments_participated }}" 
                                   class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-cyan-400 focus:outline-none"
                                   required>
                            @error('tournaments_participated')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Lanjutan -->
                <div class="space-y-6 mt-8 pt-8 border-t border-slate-700/50">
                    <h3 class="text-xl font-bold text-cyan-400">Aktivitas Lanjutan</h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Total Booking</label>
                            <input type="number" name="total_bookings" value="{{ $userStats->total_bookings }}" 
                                   class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-cyan-400 focus:outline-none"
                                   required>
                            @error('total_bookings')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Total Jam Main</label>
                            <input type="number" name="total_hours_played" value="{{ $userStats->total_hours_played }}" 
                                   step="0.5" class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:border-cyan-400 focus:outline-none"
                                   required>
                            @error('total_hours_played')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-4 mt-8 pt-8 border-t border-slate-700/50">
                    <button type="submit" class="btn-primary px-6 py-3">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.players.index') }}" class="btn-secondary px-6 py-3">
                        Batal
                    </a>
                </div>
            </form>

            <!-- Stats Preview -->
            <div class="grid md:grid-cols-3 gap-6 mt-8">
                <div class="card-premium p-6">
                    <div class="text-sm text-slate-400 mb-2">Win Rate</div>
                    <div class="text-3xl font-bold text-cyan-400">{{ $userStats->win_rate }}%</div>
                </div>

                <div class="card-premium p-6">
                    <div class="text-sm text-slate-400 mb-2">Total Pertandingan</div>
                    <div class="text-3xl font-bold text-cyan-400">{{ $userStats->wins + $userStats->losses + $userStats->draws }}</div>
                </div>

                <div class="card-premium p-6">
                    <div class="text-sm text-slate-400 mb-2">Rata-rata Poin/Jam</div>
                    <div class="text-3xl font-bold text-cyan-400">
                        {{ $userStats->total_hours_played > 0 ? round($userStats->points / $userStats->total_hours_played) : 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
