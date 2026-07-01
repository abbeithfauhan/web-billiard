<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Zone Billiard') }} - Booking Meja Billiard Modern</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="gradient-billiard min-h-screen">
        <!-- Hero Section dengan Background Premium -->
        <div class="relative overflow-hidden billiard-pattern billiard-stripes">
            <!-- Decorative Billiard Elements -->
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl billiard-glow"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl billiard-drift"></div>
            
            <!-- Floating Billiard Balls SVG -->
            <svg class="absolute top-20 right-10 w-32 h-32 opacity-10 billiard-element-pulse" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="30" cy="30" r="8" fill="#0EA5E9" class="billiard-glow"/>
                <circle cx="60" cy="40" r="8" fill="#06B6D4"/>
                <circle cx="45" cy="70" r="8" fill="#FF6B35" opacity="0.8"/>
                <line x1="20" y1="80" x2="80" y2="20" stroke="#0EA5E9" stroke-width="2" opacity="0.5"/>
            </svg>

            <!-- Billiard Table Corner Indicators -->
            <svg class="absolute bottom-10 left-5 w-24 h-24 opacity-15" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <!-- Corner pocket -->
                <circle cx="15" cy="15" r="8" fill="none" stroke="#0EA5E9" stroke-width="1" opacity="0.6"/>
                <circle cx="15" cy="15" r="5" fill="#0EA5E9" opacity="0.3"/>
            </svg>

            <!-- Cue Stick and Balls -->
            <svg class="absolute top-1/3 left-10 w-40 h-40 opacity-12 billiard-queue" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <!-- Cue stick -->
                <rect x="10" y="80" width="4" height="120" fill="#8B4513" opacity="0.6" transform="rotate(-25 20 90)"/>
                <!-- White ball -->
                <circle cx="80" cy="100" r="12" fill="white" opacity="0.7"/>
                <!-- Black ball -->
                <circle cx="130" cy="85" r="10" fill="black" opacity="0.5"/>
            </svg>

            <!-- Header -->
            <header class="sticky top-0 z-50 backdrop-blur-xl bg-slate-950/50 border-b border-cyan-400/10">
                <nav class="flex items-center justify-between px-6 py-4 lg:px-8 max-w-7xl mx-auto" aria-label="Global">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg bg-gradient-cyan-blue">
                            <span class="text-sm font-bold text-white">⚾</span>
                        </div>
                        <span class="text-2xl font-bold gradient-text-primary">{{ config('app.name') }}</span>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#features" class="text-sm font-semibold text-slate-300 hover:text-cyan-400 transition-colors">Fitur</a>
                        <a href="#content" class="text-sm font-semibold text-slate-300 hover:text-cyan-400 transition-colors">Info & Turnamen</a>
                        <a href="#contact" class="text-sm font-semibold text-slate-300 hover:text-cyan-400 transition-colors">Hubungi</a>
                    </div>

                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-cyan-400 transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary hidden sm:inline-block">Daftar</a>
                            @endif
                        @endauth
                    </div>
                </nav>
            </header>

            <!-- Hero Content -->
            <main>
                <div class="relative px-6 pt-20 pb-24 lg:px-8 lg:pt-32">
                    <div class="mx-auto max-w-4xl text-center space-y-8">
                        <!-- Badge -->
                        <div class="inline-block">
                            <span class="badge-cyan">✨ Booking Meja Billiard yang Revolusioner</span>
                        </div>

                        <!-- Heading -->
                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold font-heading tracking-tight leading-tight">
                            Temukan & Booking Meja <br>
                            <span class="gradient-text-primary">Billiard dengan Mudah</span>
                        </h1>

                        <!-- Subheading -->
                        <p class="text-lg md:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                            Jangan biarkan antrian merusak harimu. Dengan {{ config('app.name') }}, Anda bisa melihat meja yang kosong dan memesannya secara online. Cepat, mudah, dan sangat efisien.
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                            <a href="{{ route('register') }}" class="btn-primary px-8 py-3 text-base">Mulai Sekarang</a>
                            <a href="#content" class="btn-secondary px-8 py-3 text-base">Lihat Info & Turnamen</a>
                        </div>

                        <!-- Feature Pills -->
                        <div class="flex flex-wrap justify-center gap-3 pt-6">
                            <span class="px-3 py-1.5 rounded-full text-sm bg-slate-800/50 border border-slate-700/50 text-slate-300">🚀 Cepat & Responsif</span>
                            <span class="px-3 py-1.5 rounded-full text-sm bg-slate-800/50 border border-slate-700/50 text-slate-300">📱 Mobile Friendly</span>
                            <span class="px-3 py-1.5 rounded-full text-sm bg-slate-800/50 border border-slate-700/50 text-slate-300">🎯 Akurat</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Features Section -->
        <section id="features" class="py-24 px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="text-center space-y-4 mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold font-heading">Fitur Premium</h2>
                    <p class="text-lg text-slate-400 max-w-2xl mx-auto">Semua yang Anda butuhkan untuk pengalaman booking meja billiard terbaik</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    @foreach([
                        ['icon' => '⚡', 'title' => 'Booking Instan', 'desc' => 'Pesan meja favorit Anda dalam hitungan detik'],
                        ['icon' => '👥', 'title' => 'Manajemen Turnamen', 'desc' => 'Ikuti turnamen dan kompetisi yang seru'],
                        ['icon' => '📊', 'title' => 'Leaderboard', 'desc' => 'Lihat peringkat pemain dan track statistik'],
                        ['icon' => '🎁', 'title' => 'Promo Menarik', 'desc' => 'Dapatkan diskon dan reward eksklusif'],
                    ] as $feature)
                        <div class="card-premium p-8 group">
                            <div class="text-4xl mb-4 transform group-hover:scale-110 transition-transform">{{ $feature['icon'] }}</div>
                            <h3 class="text-xl font-bold text-white mb-2">{{ $feature['title'] }}</h3>
                            <p class="text-slate-400">{{ $feature['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Content Section dengan Info & Turnamen -->
        <section id="content" class="py-24 px-6 lg:px-8 border-t border-cyan-400/10">
            <div class="mx-auto max-w-7xl">
                <div class="grid lg:grid-cols-2 gap-12">
                    <!-- Info & Promo -->
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-3xl font-bold font-heading text-white mb-2">Info & Promo Terbaru</h2>
                            <p class="text-slate-400">Ikuti berita terbaru dari kami, mulai dari event hingga promo spesial.</p>
                        </div>

                        <div class="space-y-4">
                            @forelse ($informations as $info)
                                <article class="card-premium p-6 group">
                                    <div class="flex items-center gap-3 mb-3">
                                        <time datetime="{{ $info->created_at->toIso8601String() }}" class="text-xs text-slate-400">{{ $info->created_at->format('d F Y') }}</time>
                                        <span class="badge-cyan">Info</span>
                                    </div>
                                    <a href="{{ route('information.show', $info) }}" class="block group">
                                        <h3 class="text-lg font-semibold text-white group-hover:text-cyan-400 transition-colors mb-2">{{ $info->title }}</h3>
                                        <p class="text-sm text-slate-400 line-clamp-2">{{ strip_tags($info->content) }}</p>
                                    </a>
                                </article>
                            @empty
                                <div class="card-dark p-6 text-center text-slate-400">
                                    Belum ada informasi terbaru saat ini.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Turnamen -->
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-3xl font-bold font-heading text-white mb-2">Turnamen Akan Datang</h2>
                            <p class="text-slate-400">Asah kemampuanmu dan jadilah juara di kompetisi kami.</p>
                        </div>

                        <div class="space-y-4">
                            @forelse ($tournaments as $tournament)
                                <article class="card-premium p-6 group">
                                    <div class="flex items-center gap-3 mb-3">
                                        <time datetime="{{ $tournament->start_date->toIso8601String() }}" class="text-xs text-slate-400">Mulai: {{ $tournament->start_date->format('d F Y') }}</time>
                                        <span class="badge-amber">Turnamen</span>
                                    </div>
                                    <a href="{{ route('tournaments.index') }}" class="block group">
                                        <h3 class="text-lg font-semibold text-white group-hover:text-cyan-400 transition-colors mb-2">{{ $tournament->name }}</h3>
                                        <p class="text-sm text-slate-400 line-clamp-2">{{ $tournament->description }}</p>
                                    </a>
                                </article>
                            @empty
                                <div class="card-dark p-6 text-center text-slate-400">
                                    Belum ada turnamen yang dijadwalkan.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Final Section -->
        <section id="contact" class="py-24 px-6 lg:px-8">
            <div class="mx-auto max-w-4xl">
                <div class="card-premium p-12 md:p-16 text-center space-y-8">
                    <h2 class="text-3xl md:text-4xl font-bold font-heading">Siap Memulai?</h2>
                    <p class="text-lg text-slate-300">Bergabunglah dengan ribuan pengguna yang telah merasakan kemudahan booking meja billiard dengan {{ config('app.name') }}</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="btn-primary px-8 py-3 text-base">Daftar Sekarang</a>
                        <a href="mailto:contact@billiard.local" class="btn-secondary px-8 py-3 text-base">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-cyan-400/10 bg-slate-950/50 backdrop-blur-xl py-8 px-6 lg:px-8">
            <div class="mx-auto max-w-7xl flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-400">© {{ date('Y') }} {{ config('app.name') }}. Semua Hak Cipta Dilindungi.</p>
                <div class="flex gap-4">
                    <a href="#" class="text-slate-400 hover:text-cyan-400 transition-colors text-sm">Twitter</a>
                    <a href="#" class="text-slate-400 hover:text-cyan-400 transition-colors text-sm">Discord</a>
                    <a href="#" class="text-slate-400 hover:text-cyan-400 transition-colors text-sm">LinkedIn</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
