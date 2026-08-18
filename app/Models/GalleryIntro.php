<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class GalleryIntro extends Model
{
    protected $fillable = [
        'type',
        'sub_title',
        'title',
        'description',
        'banner_title',
        'banner_description',
        'banner_image',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
}
