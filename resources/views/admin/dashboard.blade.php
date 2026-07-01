@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Admin Dashboard
    </h2>
@endsection

@section('content')
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Booking Aktif</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">{{ $stats['active_bookings'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Meja</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_tables'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pengguna</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Pendapatan Hari Ini</h3>
            <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">Rp {{ number_format($stats['today_revenue']) }}</p>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <h3 class="text-lg font-medium mb-4">Akses Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.bookings.manage') }}" class="block p-4 bg-cyan-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-center font-semibold">
                    Kelola Booking
                </a>
                <a href="{{ route('admin.tables.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-center font-semibold">
                    Kelola Meja
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-center font-semibold">
                    Semua Booking
                </a>
                <a href="{{ route('admin.information.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-center font-semibold">
                    Kelola Konten
                </a>
                <a href="{{ route('admin.tournaments.index') }}" class="block p-4 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg text-center font-semibold">
                    Kelola Turnamen
                </a>
            </div>
        </div>
    </div>
@endsection