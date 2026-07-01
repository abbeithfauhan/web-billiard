<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wins',
        'losses',
        'draws',
        'points',
        'tournaments_participated',
        'ranking',
        'total_bookings',
        'total_hours_played',
    ];

    protected $casts = [
        'wins' => 'integer',
        'losses' => 'integer',
        'draws' => 'integer',
        'points' => 'integer',
        'tournaments_participated' => 'integer',
        'ranking' => 'integer',
        'total_bookings' => 'integer',
        'total_hours_played' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getWinRateAttribute()
    {
        $total = $this->wins + $this->losses + $this->draws;
        if ($total === 0) {
            return 0;
        }
        return round(($this->wins / $total) * 100, 2);
    }
}
