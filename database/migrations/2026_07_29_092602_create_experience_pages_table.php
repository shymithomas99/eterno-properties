<?php

use App\Enums\ExperienceStatus;
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
        Schema::create('experience_pages', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            // Banner
            $table->string('banner_image')->nullable();
            $table->string('banner_title');
            $table->text('banner_description')->nullable();

            // Intro
            $table->string('intro_subtitle')->nullable();
            $table->string('intro_title');
            $table->longText('intro_description')->nullable();


            // Section Button
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            $table->string('status')
                ->default(ExperienceStatus::ACTIVE->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_pages');
    }
};
