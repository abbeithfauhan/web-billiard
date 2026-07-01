<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserStats;
use Illuminate\Http\Request;

class AdminPlayerController extends Controller
{
    public function index()
    {
        $players = UserStats::with('user')
            ->orderBy('ranking')
            ->paginate(15);

        return view('admin.players.index', compact('players'));
    }

    public function edit(UserStats $userStats)
    {
        return view('admin.players.edit', compact('userStats'));
    }

    public function update(Request $request, UserStats $userStats)
    {
        $validated = $request->validate([
            'wins' => 'required|integer|min:0',
            'losses' => 'required|integer|min:0',
            'draws' => 'required|integer|min:0',
            'points' => 'required|integer|min:0',
            'tournaments_participated' => 'required|integer|min:0',
            'ranking' => 'required|integer|min:1',
            'total_bookings' => 'required|integer|min:0',
            'total_hours_played' => 'required|numeric|min:0',
        ]);

        $userStats->update($validated);

        return redirect()->route('admin.players.index')
            ->with('success', 'Data pemain berhasil diperbarui');
    }

    public function show(UserStats $userStats)
    {
        $userStats->load('user');
        $recentActivities = $userStats->user->activities()
            ->latest('created_at')
            ->limit(10)
            ->get();

        return view('admin.players.show', compact('userStats', 'recentActivities'));
    }

    public function bulkUpdate(Request $request)
    {
        $updates = $request->validate([
            'players' => 'required|array',
            'players.*.id' => 'required|exists:user_stats,id',
            'players.*.wins' => 'required|integer|min:0',
            'players.*.losses' => 'required|integer|min:0',
            'players.*.draws' => 'required|integer|min:0',
            'players.*.points' => 'required|integer|min:0',
        ]);

        foreach ($updates['players'] as $playerData) {
            UserStats::find($playerData['id'])->update([
                'wins' => $playerData['wins'],
                'losses' => $playerData['losses'],
                'draws' => $playerData['draws'],
                'points' => $playerData['points'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Data pemain berhasil diperbarui']);
    }
}
