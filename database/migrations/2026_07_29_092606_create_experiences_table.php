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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');

            $table->string('subtitle')->nullable();

            $table->string('title');

            $table->text('description')->nullable();

            // One line per experience
            $table->longText('experience_list')->nullable();

            $table->string('image')->nullable();

            $table->enum('layout', ['left', 'right'])
                ->default('right');

            $table->integer('sort_order')
                ->default(0);

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
        Schema::dropIfExists('experiences');
    }
};
