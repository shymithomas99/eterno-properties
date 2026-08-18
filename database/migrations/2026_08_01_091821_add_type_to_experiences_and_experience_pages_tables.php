<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('experience_pages', 'type')) {
            Schema::table('experience_pages', function (Blueprint $table) {
                $table->tinyInteger('type')->after('id');
            });
        }
        if (!Schema::hasColumn('experiences', 'type')) {
            Schema::table('experiences', function (Blueprint $table) {
                $table->tinyInteger('type')->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('experience_pages', 'type')) {
            Schema::table('experience_pages', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
        if (Schema::hasColumn('experiences', 'type')) {
            Schema::table('experiences', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
