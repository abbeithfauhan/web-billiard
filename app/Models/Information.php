<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'is_published', // Pastikan ini ada jika Anda menggunakannya
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($information) {
            // Buat slug secara otomatis dari judul
            $information->slug = Str::slug($information->title);
        });
    }
}