<x-guest-layout>
    <!-- Judul Halaman -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Buat Akun Baru</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Hanya butuh beberapa detik untuk memulai.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- ... (isi form nama, email, password, konfirmasi password tetap sama) ... -->
         <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Link ke Halaman Login -->
    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-cyan-500 hover:text-cyan-400 underline">
                Login di sini
            </a>
        </p>
    </div>
</x-guest-layout>