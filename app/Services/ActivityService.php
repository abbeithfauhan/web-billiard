<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\User;

class ActivityService
{
    public static function logBooking(User $user, $bookingData = null)
    {
        Activity::log(
            $user->id,
            'booking',
            'Booking Meja Billiard',
            'Pemesanan meja ' . ($bookingData['table_name'] ?? 'meja') . ' untuk ' . ($bookingData['hours'] ?? '1') . ' jam',
            $bookingData
        );
    }

    public static function logTournamentRegistration(User $user, $tournamentData = null)
    {
        Activity::log(
            $user->id,
            'tournament',
            'Daftar Tournament',
            'Mendaftar tournament: ' . ($tournamentData['tournament_name'] ?? 'Tournament Baru'),
            $tournamentData
        );
    }

    public static function logWin(User $user, $gameData = null)
    {
        Activity::log(
            $user->id,
            'win',
            'Menang Pertandingan',
            'Memenangkan pertandingan melawan ' . ($gameData['opponent'] ?? 'lawan'),
            $gameData
        );
    }

    public static function logProfileUpdate(User $user, $updateData = null)
    {
        Activity::log(
            $user->id,
            'profile',
            'Update Profil',
            'Memperbarui informasi profil',
            $updateData
        );
    }

    public static function logPayment(User $user, $paymentData = null)
    {
        Activity::log(
            $user->id,
            'payment',
            'Pembayaran Berhasil',
            'Pembayaran sebesar Rp ' . number_format($paymentData['amount'] ?? 0, 0, ',', '.'),
            $paymentData
        );
    }

    public static function logLogin(User $user)
    {
        Activity::log(
            $user->id,
            'login',
            'Login',
            'Masuk ke sistem'
        );
    }

    public static function getUserRecentActivities(User $user, $limit = 5)
    {
        return $user->activities()
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }

    public static function getAllRecentActivities($limit = 10)
    {
        return Activity::with('user')
            ->latest('created_at')
            ->limit($limit)
            ->get();
    }
}
