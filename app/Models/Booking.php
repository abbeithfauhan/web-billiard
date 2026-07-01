<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'billiard_table_id',
        'start_time',
        'end_time',
        'duration_in_minutes',
        'total_price',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_time' => 'datetime', // <-- TAMBAHKAN INI
        'end_time' => 'datetime',   // <-- DAN INI
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billiardTable()
    {
        return $this->belongsTo(BilliardTable::class);
    }
}