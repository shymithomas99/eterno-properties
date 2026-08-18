<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            // Full offer content for the modal
            $table->text('content')
                ->nullable()
                ->after('description');

            // Make button URL optional
            $table->string('button_url')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('content');

            // Change button_url back to required
            $table->string('button_url')
                ->nullable(false)
                ->change();
        });
    }
};
