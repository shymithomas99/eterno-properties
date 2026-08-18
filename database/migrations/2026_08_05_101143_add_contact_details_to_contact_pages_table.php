<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_pages', function (Blueprint $table) {

            // Phone Numbers
            $table->string('phone_1')->nullable()->after('phone');
            $table->string('phone_2')->nullable()->after('phone_1');
            $table->string('phone_3')->nullable()->after('phone_2');

            // Email Addresses
            $table->string('email_1')->nullable()->after('email');
            $table->string('email_2')->nullable()->after('email_1');

            $table->string('address_1')->nullable()->after('address');


            // Social Media Links
            $table->string('twitter_url')->nullable()->after('map_iframe');
            $table->string('youtube_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('youtube_url');
            $table->string('facebook_url')->nullable()->after('instagram_url');
        });
    }

    public function down(): void
    {
        Schema::table('contact_pages', function (Blueprint $table) {
            $table->dropColumn([
                'phone_1',
                'phone_2',
                'phone_3',
                'email_1',
                'email_2',
                'address_1',
                'twitter_url',
                'youtube_url',
                'instagram_url',
                'facebook_url',
            ]);
        });
    }
};