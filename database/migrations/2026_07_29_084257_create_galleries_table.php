<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Status;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->foreignId('resort_id')
                ->nullable()
                ->constrained('resorts');
            $table->foreignId('gallery_category_id')
                ->nullable()
                ->constrained('gallery_categories');
            $table->string('image');
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
        Schema::dropIfExists('galleries');
    }
};
