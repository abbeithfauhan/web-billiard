<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Daftar Turnamen</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))<div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert"><p class="font-bold">Sukses!</p><p>{{ session('success') }}</p></div>@endif
            @if(session('error'))<div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md" role="alert"><p class="font-bold">Gagal!</p><p>{{ session('error') }}</p></div>@endif
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($tournaments as $tournament)
                    @php
                        $now = \Carbon\Carbon::now();
                        $isOpen = $now->between($tournament->registration_open_date, $tournament->registration_deadline);
                        $isUpcoming = $now->isBefore($tournament->registration_open_date);
                        $registration = Auth::check() ? $tournament->registrations->where('user_id', Auth::id())->first() : null;
                    @endphp
                    <article class="flex flex-col overflow-hidden rounded-lg shadow-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                        {{-- BAGIAN YANG HILANG SEBELUMNYA --}}
                        <div class="flex-shrink-0 relative">
                            <img class="h-56 w-full object-cover" src="{{ $tournament->image ? asset('storage/' . $tournament->image) : 'https://via.placeholder.com/400x250.png/1e293b/ffffff?text=Zone+Billiard' }}" alt="Poster Turnamen">
                            <div class="absolute top-0 right-0 m-2">
                                @if($isOpen) <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">Pendaftaran Dibuka</span>
                                @elseif($isUpcoming) <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800">Segera</span>
                                @else <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">Ditutup</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col justify-between p-6">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-cyan-600 dark:text-cyan-400"><span>Mulai: {{ $tournament->start_date->format('d F Y') }}</span></p>
                                <h3 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">{{ $tournament->name }}</h3>
                                <p class="mt-3 text-base text-gray-500 dark:text-gray-400 line-clamp-3">{{ $tournament->description }}</p>
                            </div>
                            {{-- AKHIR DARI BAGIAN YANG HILANG --}}
                            <div class="mt-6">
                                @if($registration && $registration->status !== 'cancelled')
                                    <a href="{{ route('tournaments.my') }}" class="flex justify-center items-center w-full rounded-md px-4 py-2.5 text-sm font-semibold text-white {{ $registration->status == 'pending' ? 'bg-yellow-500' : 'bg-emerald-600' }} cursor-pointer hover:opacity-90">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span>Status: {{ ucfirst($registration->status) }}</span>
                                    </a>
                                @elseif($isOpen)
                                    <button type="button" onclick="openRegistrationModal('{{ $tournament->slug }}', '{{ $tournament->name }}', '{{ number_format($tournament->entry_fee, 0, ',', '.') }}')" class="w-full rounded-md bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500">Daftar Sekarang</button>
                                @else
                                    <button disabled class="w-full rounded-md bg-gray-300 dark:bg-gray-600 px-4 py-2.5 text-sm font-semibold text-gray-500 dark:text-gray-400 cursor-not-allowed">
                                        @if($isUpcoming) Pendaftaran Dibuka {{ $tournament->registration_open_date->diffForHumans() }} @else Pendaftaran Ditutup @endif
                                    </button>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-center py-10 text-gray-500">Belum ada turnamen yang dijadwalkan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Pendaftaran Turnamen -->
    <div id="registrationModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-lg">
            <form id="registrationForm" action="" method="POST" class="space-y-6">
                @csrf
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Konfirmasi Pendaftaran</h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">Anda akan mendaftar untuk turnamen: <strong id="modalTournamentName" class="text-gray-800 dark:text-gray-200"></strong></p>
                </div>
                <div class="border-t border-b border-gray-200 dark:border-gray-700 py-4 space-y-3">
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Nama Pendaftar:</span><span class="font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Email:</span><span class="font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->email }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Biaya Pendaftaran:</span><span id="modalEntryFee" class="font-semibold text-gray-800 dark:text-gray-200"></span></div>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Instruksi Pembayaran</h4>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Silakan datang ke Zone Billiard dan <br>
                        berikan bukti pendaftarannya kepada kasir.
                    </p>
                </div>
                <div class="flex justify-end space-x-4 pt-4">
                    <button type="button" onclick="closeRegistrationModal()" class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-semibold text-sm">Batal</button>
                    <x-primary-button>Konfirmasi & Daftar</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRegistrationModal(slug, name, fee) {
            const modal = document.getElementById('registrationModal');
            const form = document.getElementById('registrationForm');
            form.action = `/tournaments/${slug}/register`; 
            modal.querySelector('#modalTournamentName').innerText = name;
            modal.querySelector('#modalEntryFee').innerText = 'Rp ' + fee;
            modal.classList.remove('hidden');
        }
        function closeRegistrationModal() {
            document.getElementById('registrationModal').classList.add('hidden');
        }
    </script>
</x-app-layout>