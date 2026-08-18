<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\OfferIntro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferIntroHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfferIntro::updateOrCreate(
            ['type' => 1],
            [
                'sub_title' => 'SPECIAL OFFERS',
                'title' => 'Exclusive Packages & Seasonal Deals',
                'description' => 'Discover special offers crafted to make your stay even more memorable. Enjoy exclusive benefits, seasonal discounts and curated experiences available for a limited time.',
                'banner_title' => null,
                'banner_description' => null,
                'banner_image'  => null,
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
