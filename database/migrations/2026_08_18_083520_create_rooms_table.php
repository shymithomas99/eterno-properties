<?php

use App\Enums\Status;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('main_image')->nullable();

            $table->string('bed_type')->nullable();
            $table->string('guests')->nullable();
            $table->string('size')->nullable();
            $table->string('view')->nullable();

            $table->string('booking_url')->nullable();

            $table->unsignedInteger('sort_order')->default(0);
            $table->string('status')->default(Status::ACTIVE->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
