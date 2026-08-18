<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\VideoSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideoSection::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'An Invitation to a New World',
                'thumbnail_image'  => 'default/home-video-thumbnail.jpg',
                'video' => 'default/home-video.mp4',
                'status' => Status::ACTIVE->value,
            ]
        );
    }
}
