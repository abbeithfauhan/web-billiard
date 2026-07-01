@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tambah Turnamen Baru</h2>
@endsection

@section('content')
    <form action="{{ route('admin.tournaments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-xl">
            <div class="px-4 py-5 sm:p-6 space-y-6">
                <div>
                    <x-input-label for="name" value="Nama Turnamen" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-input-label for="description" value="Deskripsi" />
                    <textarea id="description" name="description" rows="5" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="start_date" value="Tanggal Mulai Turnamen" />
                        <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-1 block w-full" :value="old('start_date')" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                    </div>
                    <div>
                        <x-input-label for="entry_fee" value="Biaya Pendaftaran (Rp)" />
                        <x-text-input id="entry_fee" name="entry_fee" type="number" placeholder="50000" class="mt-1 block w-full" :value="old('entry_fee', 0)" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('entry_fee')" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="registration_open_date" value="Pendaftaran Dibuka" />
                        <x-text-input id="registration_open_date" name="registration_open_date" type="datetime-local" class="mt-1 block w-full" :value="old('registration_open_date')" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('registration_open_date')" />
                    </div>
                    <div>
                        <x-input-label for="registration_deadline" value="Pendaftaran Ditutup" />
                        <x-text-input id="registration_deadline" name="registration_deadline" type="datetime-local" class="mt-1 block w-full" :value="old('registration_deadline')" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('registration_deadline')" />
                    </div>
                </div>
                <div>
                    <x-input-label for="image" value="Poster/Gambar Turnamen (Opsional)" />
                    <input id="image" name="image" type="file" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100">
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>
            </div>
            <div class="flex items-center justify-end gap-4 bg-gray-50 dark:bg-gray-700/50 px-4 py-3 text-right sm:px-6 rounded-b-xl">
                <a href="{{ route('admin.tournaments.index') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
                <x-primary-button>Simpan Turnamen</x-primary-button>
            </div>
        </div>
    </form>
@endsection