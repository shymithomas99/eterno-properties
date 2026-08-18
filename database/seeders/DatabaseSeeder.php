<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            BannerHomeSeeder::class,
            WelcomeSectionSeeder::class,
            VideoSectionSeeder::class,
            ResortIntroHomeSeeder::class,
            OfferIntroHomeSeeder::class,
            OfferIntroSeeder::class,
            GalleryIntroHomeSeeder::class,
            GalleryIntroSeeder::class,
            TestimonialIntroHomeSeeder::class,
        ]);
    }
}
