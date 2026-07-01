<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentRegistration extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'tournament_id', 'status'];

    /**
     * Mendefinisikan relasi bahwa setiap pendaftaran
     * dimiliki oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Mendefinisikan relasi bahwa setiap pendaftaran
     * merujuk ke satu Tournament.
     */
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }
}