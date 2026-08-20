<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('offers', 'resort_id')) {
            Schema::table('offers', function (Blueprint $table) {
                $table->dropForeign(['resort_id']);
                $table->dropColumn('resort_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('resort_id')
                ->nullable()
                ->constrained('resorts');
        });
    }
};
