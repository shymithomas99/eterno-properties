<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\GalleryIntro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryIntroHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GalleryIntro::updateOrCreate(
            ['type' => 1],
            [
                'sub_title' => 'GALLERY PREVIEW',
                'title' => 'Moments Worth Remembering',
                'description' => 'Explore stunning landscapes, luxurious accommodations and unforgettable experiences through our collection of photographs showcasing the essence of Eterno Hotels & Resorts.',
                'banner_title' => null,
                'banner_description' => null,
                'banner_image'  => null,
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
