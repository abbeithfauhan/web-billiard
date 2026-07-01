@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tambah Meja Baru</h2>
@endsection

@section('content')
    <form action="{{ route('admin.tables.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Meja')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <!-- Type -->
            <div class="mt-4">
                <x-input-label for="type" :value="__('Tipe Meja')" />
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="regular" {{ old('type') == 'regular' ? 'selected' : '' }}>Regular</option>
                    <option value="vip" {{ old('type') == 'vip' ? 'selected' : '' }}>VIP</option>
                </select>
            </div>
            <!-- Price per Hour -->
            <div class="mt-4">
                <x-input-label for="price_per_hour" :value="__('Harga per Jam')" />
                <x-text-input id="price_per_hour" name="price_per_hour" type="number" class="mt-1 block w-full" :value="old('price_per_hour')" required />
                <x-input-error class="mt-2" :messages="$errors->get('price_per_hour')" />
            </div>
            <!-- Status -->
            <div class="mt-4">
                <x-input-label for="is_active" :value="__('Status')" />
                <select name="is_active" id="is_active" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <div class="flex items-center gap-4 mt-6">
                <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                <a href="{{ route('admin.tables.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
            </div>
        </div>
    </form>
@endsection