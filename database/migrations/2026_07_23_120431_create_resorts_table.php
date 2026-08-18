<?php

use App\Enums\WebinarStatus;
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
        Schema::create('resorts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(1);
            $table->string('home_place')->nullable();
            $table->string('home_title')->nullable();
            $table->text('home_description')->nullable();
            $table->string('home_image')->nullable();
            $table->string('home_button_text')->nullable();
            $table->string('home_status')->default(Status::INACTIVE->value);
            $table->timestamp('home_updated_at')->nullable();
            $table->string('mega_menu_sub_title')->nullable();
            $table->string('mega_menu_title')->nullable();
            $table->text('mega_menu_description')->nullable();
            $table->string('mega_menu_image')->nullable();
            $table->string('mega_menu_status')->default(Status::INACTIVE->value);
            $table->timestamp('mega_menu_updated_at')->nullable();
            $table->string('book_now_image')->nullable();
            $table->string('book_now_status')->default(Status::INACTIVE->value);
            $table->timestamp('book_now_updated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resorts');
    }
};