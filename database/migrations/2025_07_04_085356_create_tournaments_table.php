<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tournaments', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description');
        $table->string('image')->nullable();
        $table->dateTime('start_date');
        $table->dateTime('registration_open_date');
        $table->dateTime('registration_deadline');
        $table->decimal('entry_fee', 10, 2)->default(0);
        $table->timestamps();
    });
    }
    public function down(): void {
        Schema::dropIfExists('tournaments');
    }
};