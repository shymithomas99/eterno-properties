<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\ResortIntro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResortIntroHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResortIntro::updateOrCreate(
            ['id' => 1],
            [
                'sub_title' => 'DISCOVER YOUR PERFECT ESCAPE',
                'title' => 'Explore Our Resorts',
                'description' => null,
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
