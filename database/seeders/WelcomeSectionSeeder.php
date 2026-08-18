<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\WelcomeSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WelcomeSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WelcomeSection::updateOrCreate(
            ['id' => 1],
            [
                'sub_title' => 'WELCOME',
                'title' => 'Eterno',
                'description' => 'At Eterno Hotels & Resorts, we believe that every destination has a story waiting to be experienced. Our properties are thoughtfully designed to blend luxury with the natural beauty of their surroundings, offering guests immersive stays that create lasting memories.',
                'left_image'  => 'default/home-welcome-left.jpg',
                'right_image' => 'default/home-welcome-right.jpg',
                'button_text' => 'Learn More',
                'button_url'  => 'https://eterno.com/about',
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
