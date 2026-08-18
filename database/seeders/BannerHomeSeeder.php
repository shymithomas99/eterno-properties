<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::updateOrCreate(
            ['id' => 1],
            [
                'type' => 1,
                'title' => 'An Invitation to the new world',
                'description' => 'Eterno Hotels & Resorts brings together exceptional destinations where nature, comfort and unforgettable experiences come together.',
                'image' => null,
                'sort_order' => 1,
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
