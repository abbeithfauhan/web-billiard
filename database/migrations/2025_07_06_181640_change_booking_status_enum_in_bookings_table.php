<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Mengubah enum ke nilai baru, dengan default 'pending'
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])
                  ->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Mengembalikan ke state lama jika migrasi di-rollback
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])
                  ->default('pending')->change();
        });
    }
};