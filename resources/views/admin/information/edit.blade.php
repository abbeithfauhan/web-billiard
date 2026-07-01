@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Informasi: {{ $information->title }}</h2>
@endsection

@section('content')
    <form action="{{ route('admin.information.update', $information) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-xl">
            <div class="px-4 py-5 sm:p-6 space-y-6">
                <div>
                    <x-input-label for="title" value="Judul Informasi" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $information->title)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>
                <div>
                    <x-input-label for="content" value="Konten" />
                    <textarea id="content" name="content" rows="10" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('content', $information->content) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                </div>
                <div>
                    <x-input-label for="image" value="Ganti Gambar (Opsional)" />
                    <input id="image" name="image" type="file" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/50 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100">
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    @if($information->image)
                        <div class="mt-4"><p class="text-sm text-gray-500 dark:text-gray-400">Gambar saat ini:</p><img src="{{ asset('storage/' . $information->image) }}" alt="{{ $information->title }}" class="mt-2 h-32 w-auto rounded-md"></div>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-end gap-4 bg-gray-50 dark:bg-gray-700/50 px-4 py-3 text-right sm:px-6 rounded-b-xl">
                <a href="{{ route('admin.information.index') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
                <x-primary-button>Perbarui Informasi</x-primary-button>
            </div>
        </div>
    </form>
@endsection