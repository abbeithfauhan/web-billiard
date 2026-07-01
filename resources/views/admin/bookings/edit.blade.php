@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Booking #{{ $booking->id }}</h2>
@endsection

@section('content')
    <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    {{-- Pengguna --}}
                    <div>
                        <x-input-label for="user_id" value="Pengguna" class="text-gray-300" />
                        <input type="text" disabled value="{{ $booking->user->name }}" class="mt-1 block w-full border-gray-600 bg-gray-700 text-gray-300 rounded-md shadow-sm cursor-not-allowed">
                    </div>

                    {{-- Meja Billiard --}}
                    <div>
                        <x-input-label for="billiard_table_id" value="Meja Billiard" class="text-gray-300" />
                        <select name="billiard_table_id" id="billiard_table_id" class="mt-1 block w-full border-gray-600 bg-gray-900 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                            @foreach($tables as $table)
                                <option value="{{ $table->id }}" {{ old('billiard_table_id', $booking->billiard_table_id) == $table->id ? 'selected' : '' }}>
                                    {{ $table->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Waktu Mulai --}}
                    <div>
                        <x-input-label for="start_time" value="Waktu Mulai" class="text-gray-300" />
                        <x-text-input id="start_time" name="start_time" type="datetime-local" class="mt-1 block w-full" :value="old('start_time', $booking->start_time->format('Y-m-d\TH:i'))" required />
                    </div>

                    {{-- Durasi --}}
                    <div>
                        <x-input-label for="duration" value="Durasi (dalam jam)" class="text-gray-300" />
                        <x-text-input id="duration" name="duration" type="number" class="mt-1 block w-full" :value="old('duration', $booking->duration_in_minutes / 60)" required />
                    </div>

                    {{-- Status Booking --}}
                    <div>
                        <x-input-label for="status" value="Status Booking" class="text-gray-300" />
                        <select name="status" id="status" class="mt-1 block w-full border-gray-600 bg-gray-900 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ old('status', 'completed') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-6 pt-6 border-t border-gray-700">
                    <a href="{{ route('admin.bookings.index') }}" class="text-sm text-gray-400 hover:underline">Batal</a>
                    <x-primary-button>Perbarui Booking</x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection