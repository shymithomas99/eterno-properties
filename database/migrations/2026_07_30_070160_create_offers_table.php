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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->foreignId('resort_id')
                ->nullable()
                ->constrained('resorts');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('button_text');
            $table->string('button_url');
            $table->unsignedInteger('sort_order')->default(1);
            $table->string('status')->default(Status::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
