<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tournament extends Model {
    protected $fillable = ['name', 'slug', 'description', 'image', 'start_date', 'registration_open_date', 'registration_deadline', 'entry_fee'];
    protected $casts = ['start_date' => 'datetime', 'registration_open_date' => 'datetime', 'registration_deadline' => 'datetime'];
    protected static function boot() { parent::boot(); static::creating(fn($m) => $m->slug = Str::slug($m->name)); }

    public function getRouteKeyName() { return 'slug'; }

   
    public function registrations()
    {
        return $this->hasMany(TournamentRegistration::class);
    }
}