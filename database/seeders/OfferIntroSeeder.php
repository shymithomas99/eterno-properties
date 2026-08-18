<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\OfferIntro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferIntroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfferIntro::updateOrCreate(
            ['type' => 2],
            [
                'sub_title' => null,
                'title' => null,
                'description' => null,
                'banner_title' => 'Exclusive Offers Await',
                'banner_description' => 'Discover limited-time offers designed to make your getaway even more memorable',
                'banner_image'  => 'default/offer-banner.jpg',
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
