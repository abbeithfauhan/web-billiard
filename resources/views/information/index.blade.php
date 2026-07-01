<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Informasi & Promo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">

                @forelse ($informations as $info)
                    {{-- KOREKSI: Gunakan $info, bukan $item --}}
                    <article class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                        @if ($info->image)
                            <img src="{{ asset('storage/' . $info->image) }}" alt="{{ $info->title }}" class="w-full h-64 object-cover">
                        @endif
                        <div class="p-6 md:p-8">
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">INFO</p>
                            <h3 class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{-- KOREKSI: Gunakan $info, bukan $item --}}
                                <a href="{{ route('information.show', $info) }}">{{ $info->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{-- KOREKSI: Gunakan $info, bukan $item --}}
                                Dipublikasikan pada {{ $info->created_at->format('d F Y') }}
                            </p>
                            <div class="mt-4 prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                                {{-- KOREKSI: Gunakan $info, bukan $item --}}
                                {!! \Illuminate\Support\Str::limit(strip_tags($info->content), 200) !!}
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                        <p class="text-gray-500 dark:text-gray-400">Belum ada informasi terbaru saat ini.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>