<?php

use App\Enums\AboutStatus;
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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            /*
    |--------------------------------------------------------------------------
    | Banner Section
    |--------------------------------------------------------------------------
    */
            $table->string('banner_image')->nullable();
            $table->string('banner_title');
            $table->text('banner_description')->nullable();


            /*
    |--------------------------------------------------------------------------
    | About / Introduction Section
    |--------------------------------------------------------------------------
    */
            $table->string('intro_image')->nullable();
            $table->string('intro_title');
            $table->longText('intro_description')->nullable();


            /*
    |--------------------------------------------------------------------------
    | CTA Section
    |--------------------------------------------------------------------------
    */
            $table->string('cta_background_image')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_link')->nullable();


            /*
    |--------------------------------------------------------------------------
    | Common
    |--------------------------------------------------------------------------
    */
            $table->string('status')
                ->default(AboutStatus::ACTIVE->value);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};