<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
        <title>{{ config('app.name', 'Zone Billiard') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    <h1 class="text-white text-2xl font-bold mt-2 text-center">{{ config('app.name') }}</h1>
                </a>
            </div>

            {{-- PERUBAHAN UTAMA ADA DI SINI --}}
            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-gray-800 shadow-lg overflow-hidden sm:rounded-2xl border border-gray-700">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>