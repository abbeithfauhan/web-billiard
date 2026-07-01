<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BilliardTable;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'active_bookings' => Booking::where('status', 'confirmed')->where('end_time', '>', now())->count(),
            'total_tables' => BilliardTable::count(),
            'total_users' => User::where('role', 'user')->count(),

            
            'today_revenue' => Booking::whereIn('status', ['confirmed', 'completed']) 
                                    ->whereDate('start_time', today()) 
                                    ->sum('total_price'),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}