<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detail Informasi
            </h2>
            <a href="{{ route('information.index') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                ← Kembali ke Daftar Informasi
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                @if($info->image)
                    <img src="{{ asset('storage/' . $info->image) }}" alt="{{ $info->title }}" class="w-full h-96 object-cover">
                @endif
                
                <div class="p-6 md:p-8">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Dipublikasikan pada {{ $info->created_at->format('d F Y') }}
                    </p>
                    <h1 class="mt-2 text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100">
                        {{ $info->title }}
                    </h1>
                    <div class="mt-6 prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                        {{-- Tampilkan konten penuh, bukan potongan --}}
                        {!! $info->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>