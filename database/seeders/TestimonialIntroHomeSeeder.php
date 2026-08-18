<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\TestimonialIntro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialIntroHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestimonialIntro::updateOrCreate(
            ['id' => 1],
            [
                'sub_title' => 'TESTIMONIALS',
                'title' => 'Valuable words from our guests',
                'description' => 'Every journey at Eterno is defined by exceptional hospitality, scenic beauty and personalized experiences. Hear from guests who have discovered comfort, tranquility and unforgettable moments amidst the stunning landscapes of Munnar and Vagamon.',
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
