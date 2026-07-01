<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Booking Meja Billiard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Pilih Meja yang Tersedia</h3>

                    {{-- Legenda Indikator --}}
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="flex items-center"><div class="w-5 h-5 bg-green-500 rounded-md mr-2"></div><span>Kosong</span></div>
                        <div class="flex items-center"><div class="w-5 h-5 bg-red-500 rounded-md mr-2"></div><span>Dipakai</span></div>
                        <div class="flex items-center"><div class="w-5 h-5 bg-gray-500 rounded-md mr-2"></div><span>Tidak Aktif</span></div>
                    </div>

                    {{-- Tampilan Denah Meja --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        @forelse ($tables as $table)
                            @php
                                $isClickable = $table->is_active && $table->status === 'kosong';
                                $bgColor = 'bg-gray-700'; 
                                $textColor = 'text-gray-400';
                                $cursor = 'cursor-not-allowed';
                                $hoverEffect = '';
                                if ($table->is_active) {
                                    if ($table->status === 'kosong') {
                                        $bgColor = 'bg-green-600';
                                        $textColor = 'text-white';
                                        $cursor = 'cursor-pointer';
                                        $hoverEffect = 'hover:bg-green-500 hover:scale-105';
                                    } else {
                                        $bgColor = 'bg-red-600';
                                        $textColor = 'text-white';
                                    }
                                }
                            @endphp
                            <div 
                                class="p-4 rounded-lg shadow-lg text-center transition-all duration-300 transform {{ $bgColor }} {{ $textColor }} {{ $cursor }} {{ $hoverEffect }}"
                                @if($isClickable)
                                    onclick="openBookingModal('{{ $table->id }}', '{{ $table->name }}')"
                                @endif
                            >
                                <svg class="w-16 h-16 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.5,10.5H2.5a.5.5,0,0,0-.5.5v8a.5.5,0,0,0,.5.5h19a.5.5,0,0,0,.5-.5v-8A.5.5,0,0,0,21.5,10.5ZM4.4,13.15a1,1,0,1,1,1-1,1,1,0,0,1-1,1Zm15.2,0a1,1,0,1,1,1-1,1,1,0,0,1-1,1Zm-5.3,0a1,1,0,1,1,1-1,1,1,0,0,1-1,1ZM3,6.5A.5.5,0,0,1,3.5,6H20.5a.5.5,0,0,1,0,1H3.5A.5.5,0,0,1,3,6.5Zm1-2A.5.5,0,0,1,4.5,4h15a.5.5,0,0,1,0,1h-15A.5.5,0,0,1,4,4.5Z"/></svg>
                                <span class="font-bold text-lg">{{ $table->name }}</span>
                                <span class="block text-sm capitalize">{{ $table->type }}</span>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8"><p class="text-gray-500">Gagal memuat data meja.</p></div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Booking -->
    <div id="bookingModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md">
            <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Booking <span id="modalTableName"></span></h3>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="billiard_table_id" id="modalTableId">
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-4">
                    <x-input-label for="start_time" class="dark:text-gray-300" value="Jam Mulai" />
                    <x-text-input type="datetime-local" name="start_time" id="start_time" class="mt-1 block w-full" :value="old('start_time')" required />
                    <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                </div>
                <div class="mb-6">
                    <x-input-label for="duration" class="dark:text-gray-300" value="Durasi (dalam jam)" />
                    <select name="duration" id="duration" class="mt-1 block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" required>
                        <option value="1">1 Jam</option>
                        <option value="2">2 Jam</option>
                        <option value="3">3 Jam</option>
                        <option value="4">4 Jam</option>
                        <option value="5">5 Jam</option>
                    </select>
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeBookingModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Booking Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    
    <script>
        function openBookingModal(tableId, tableName) {
            // Reset form dan hapus error lama jika ada
            const form = document.querySelector('#bookingModal form');
            form.reset();
            const errorDiv = form.querySelector('[role="alert"]');
            if (errorDiv) {
                errorDiv.style.display = 'none';
            }

            // Set data meja yang dipilih
            document.getElementById('modalTableId').value = tableId;
            document.getElementById('modalTableName').innerText = tableName;

            // Tampilkan modal
            document.getElementById('bookingModal').classList.remove('hidden');
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                const tableId = '{{ old("billiard_table_id") }}';
                const tableName = `Meja ${tableId}`; 
                if (tableId) {
                    openBookingModal(tableId, tableName);
                }
            });
        @endif
    </script>
</x-app-layout>