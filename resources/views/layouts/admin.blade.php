<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
        <title>{{ config('app.name', 'Zone Billiard') }} - Admin Panel</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900" x-data="{ sidebarOpen: true }">
            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-gray-800 border-r dark:border-gray-700 transform transition-transform duration-300 ease-in-out sm:translate-x-0">
                {{-- KODE SIDEBAR DI SINI SAMA SEPERTI SEBELUMNYA, TIDAK ADA PERUBAHAN --}}
                <div class="flex items-center justify-center h-16 border-b dark:border-gray-700">
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
                
            <nav class="mt-4 px-2 space-y-1">
                <x-admin-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">{{ __('Dashboard') }}</x-admin-nav-link>
                <x-admin-nav-link :href="route('admin.tables.index')" :active="request()->routeIs('admin.tables.*')">{{ __('Kelola Meja') }}</x-admin-nav-link>
                <x-admin-nav-link :href="route('admin.bookings.manage')" :active="request()->routeIs('admin.bookings.manage')">{{ __('Kelola Booking') }}</x-admin-nav-link>
                <x-admin-nav-link :href="route('admin.bookings.index')" :active="request()->routeIs('admin.bookings.index')">{{ __('Semua Booking') }}</x-admin-nav-link>
                <x-admin-nav-link :href="route('admin.information.index')" :active="request()->routeIs('admin.information.*')">{{ __('Kelola Informasi') }}</x-admin-nav-link>
                <x-admin-nav-link :href="route('admin.tournaments.index')" :active="request()->routeIs('admin.tournaments.*')">{{ __('Kelola Turnamen') }}</x-admin-nav-link>
                <hr class="my-2 border-gray-200">
                <x-admin-nav-link :href="route('dashboard')">{{ __('Kembali ke Beranda') }}</x-admin-nav-link>
            </nav>
            </aside>

            <div class="flex-1 flex flex-col sm:pl-64">
                <!-- Top Bar -->
                <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-30">
                    {{-- KODE TOP BAR DI SINI SAMA SEPERTI SEBELUMNYA, TIDAK ADA PERUBAHAN --}}
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 dark:text-gray-400 focus:outline-none sm:hidden">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>
                            <div class="flex-1"></div>
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>
                                            <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </header>
                
                <!-- Page Heading -->
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
                
                <!-- Page Content -->
                <main class="flex-1 p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>