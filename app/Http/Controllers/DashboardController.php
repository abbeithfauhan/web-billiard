<?php

namespace App\Http\Controllers;

use App\Models\UserStats;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard/beranda utama.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        
        // Get user stats
        $userStats = $user->stats ?? UserStats::firstOrCreate(
            ['user_id' => $user->id],
            [
                'wins' => 0,
                'losses' => 0,
                'draws' => 0,
                'points' => 0,
                'tournaments_participated' => 0,
                'ranking' => 0,
                'total_bookings' => 0,
                'total_hours_played' => 0,
            ]
        );

        // Get user recent activities
        $recentActivities = ActivityService::getUserRecentActivities($user, 5);

        return view('dashboard', compact('userStats', 'recentActivities'));
    }
}
