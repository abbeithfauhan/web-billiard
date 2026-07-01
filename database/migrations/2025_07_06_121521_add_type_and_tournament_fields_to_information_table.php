<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('information', function (Blueprint $table) {
            // Kolom untuk membedakan jenis konten
            $table->string('type')->default('info')->after('content'); // 'info' atau 'tournament'
            
            // Kolom-kolom khusus turnamen (bisa diisi null jika tipenya 'info')
            $table->dateTime('start_date')->nullable()->after('type');
            $table->decimal('entry_fee', 10, 2)->nullable()->after('start_date');
        });
    }

    public function down(): void
    {
        Schema::table('information', function (Blueprint $table) {
            $table->dropColumn(['type', 'start_date', 'entry_fee']);
        });
    }
};
