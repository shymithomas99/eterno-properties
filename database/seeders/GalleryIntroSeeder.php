<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\GalleryIntro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryIntroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GalleryIntro::updateOrCreate(
            ['type' => 2],
            [
                'sub_title' => null,
                'title' => null,
                'description' => null,
                'banner_title' => 'Every Picture Tells a Story',
                'banner_description' => 'Explore breathtaking moments from our resorts through carefully curated imagery',
                'banner_image'  => 'default/gallery-banner.jpg',
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
