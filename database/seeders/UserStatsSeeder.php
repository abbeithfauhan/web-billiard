<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserStats;
use Illuminate\Database\Seeder;

class UserStatsSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $topPlayers = [
            ['wins' => 45, 'losses' => 8, 'draws' => 3, 'points' => 4500, 'tournaments' => 12, 'ranking' => 1],
            ['wins' => 38, 'losses' => 12, 'draws' => 4, 'points' => 3800, 'tournaments' => 10, 'ranking' => 2],
            ['wins' => 35, 'losses' => 14, 'draws' => 3, 'points' => 3500, 'tournaments' => 9, 'ranking' => 3],
            ['wins' => 32, 'losses' => 15, 'draws' => 5, 'points' => 3200, 'tournaments' => 8, 'ranking' => 4],
            ['wins' => 28, 'losses' => 18, 'draws' => 4, 'points' => 2800, 'tournaments' => 7, 'ranking' => 5],
        ];

        foreach ($users as $index => $user) {
            $data = $topPlayers[$index] ?? [
                'wins' => rand(5, 25),
                'losses' => rand(5, 20),
                'draws' => rand(0, 3),
                'points' => rand(500, 2500),
                'tournaments' => rand(2, 6),
                'ranking' => $index + 1,
            ];

            UserStats::create([
                'user_id' => $user->id,
                'wins' => $data['wins'],
                'losses' => $data['losses'],
                'draws' => $data['draws'],
                'points' => $data['points'],
                'tournaments_participated' => $data['tournaments'],
                'ranking' => $data['ranking'],
                'total_bookings' => rand(20, 100),
                'total_hours_played' => rand(50, 300),
            ]);
        }
    }
}
