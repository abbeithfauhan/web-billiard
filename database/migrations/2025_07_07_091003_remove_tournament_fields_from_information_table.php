<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('information', function (Blueprint $table) {
            if (Schema::hasColumn('information', 'type')) { $table->dropColumn('type'); }
            if (Schema::hasColumn('information', 'start_date')) { $table->dropColumn('start_date'); }
            if (Schema::hasColumn('information', 'entry_fee')) { $table->dropColumn('entry_fee'); }
        });
    }
};