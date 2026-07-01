<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminTournamentController;
use App\Http\Controllers\Admin\AdminInformationController;
use App\Http\Controllers\Admin\AdminPlayerController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/my-bookings', [BookingController::class, 'history'])->name('booking.history');
    Route::get('/tournaments', [TournamentController::class, 'index'])->name('tournaments.index');
    Route::post('/tournaments/{tournament:slug}/register', [TournamentController::class, 'register'])->name('tournaments.register');
    Route::get('/informasi', [InformationController::class, 'index'])->name('information.index');
    Route::get('/informasi/{information:slug}', [InformationController::class, 'show'])->name('information.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-tournaments', [TournamentController::class, 'myTournaments'])->name('tournaments.my');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('tables', TableController::class);
    Route::get('/bookings/manage', [AdminBookingController::class, 'manage'])->name('bookings.manage');
    Route::patch('/bookings/{booking}/confirm', [AdminBookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('/bookings/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');
    Route::resource('bookings', AdminBookingController::class)->only([
        'index', 'edit', 'update', 'destroy'
    ]);
    Route::resource('information', AdminInformationController::class);
    Route::resource('tournaments', AdminTournamentController::class);
    Route::get('/tournaments/{tournament}/registrations', [AdminTournamentController::class, 'showRegistrations'])->name('tournaments.registrations');
    Route::patch('/registrations/{registration}/confirm', [AdminTournamentController::class, 'confirmRegistration'])->name('registrations.confirm');
    Route::patch('/registrations/{registration}/cancel', [AdminTournamentController::class, 'cancelRegistration'])->name('registrations.cancel');
    Route::resource('players', AdminPlayerController::class);
    Route::post('/players/bulk-update', [AdminPlayerController::class, 'bulkUpdate'])->name('players.bulkUpdate');
});

require __DIR__.'/auth.php';
