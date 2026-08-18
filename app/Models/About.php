<?php

namespace App\Models;

use App\Enums\AboutStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use SoftDeletes;


    protected $fillable = [

        'banner_image',
        'banner_title',
        'banner_description',

        'intro_image',
        'intro_title',
        'intro_description',

        'cta_background_image',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_link',

        'status'
    ];

    protected function casts(): array
    {
        return [
            'status' => AboutStatus::class,
        ];
    }
}
