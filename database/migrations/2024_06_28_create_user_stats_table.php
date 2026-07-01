<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('wins')->default(0);
            $table->integer('losses')->default(0);
            $table->integer('draws')->default(0);
            $table->integer('points')->default(0);
            $table->integer('tournaments_participated')->default(0);
            $table->integer('ranking')->default(0);
            $table->integer('total_bookings')->default(0);
            $table->float('total_hours_played')->default(0);
            $table->timestamps();
            
            $table->unique('user_id');
            $table->index('ranking');
            $table->index('points');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_stats');
    }
};
