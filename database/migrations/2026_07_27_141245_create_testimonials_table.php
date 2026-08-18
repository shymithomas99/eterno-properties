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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resort_id')
                ->constrained('resorts')
                ->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->string('customer_name');
            $table->string('customer_place');
            $table->string('customer_image');
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
        Schema::dropIfExists('testimonials');
    }
};
