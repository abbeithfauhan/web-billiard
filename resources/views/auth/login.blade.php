<x-guest-layout>
    <!-- Judul Halaman -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Selamat Datang Kembali!</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Silakan login untuk melanjutkan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- ... (isi form email, password, remember me tetap sama) ... -->
        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log In') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Link ke Halaman Register -->
    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-cyan-500 hover:text-cyan-400 underline">
                Daftar di sini
            </a>
        </p>
    </div>
</x-guest-layout>