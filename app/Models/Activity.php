<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description',
        'data',
        'created_at',
    ];

    protected $casts = [
        'data' => 'json',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($userId, $type, $title, $description = null, $data = null)
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'data' => $data,
        ]);
    }

    public function getActivityIcon()
    {
        return match ($this->type) {
            'booking' => '📅',
            'tournament' => '🏆',
            'profile' => '👤',
            'payment' => '💳',
            'win' => '🎯',
            'login' => '🔐',
            default => '📌',
        };
    }
}
