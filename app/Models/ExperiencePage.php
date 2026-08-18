<?php

namespace App\Models;

use App\Enums\ExperienceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperiencePage extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'type',

        'banner_image',

        'banner_title',

        'banner_description',

        'intro_subtitle',

        'intro_title',

        'intro_description',

        'button_text',

        'button_url',

        'status'

    ];

    protected $casts = [

        'status' => ExperienceStatus::class

    ];
}