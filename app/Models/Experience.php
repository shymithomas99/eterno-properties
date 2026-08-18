<?php

namespace App\Models;

use App\Enums\ExperienceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'subtitle',
        'title',
        'description',
        'experience_list',
        'image',
        'layout',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => ExperienceStatus::class,
    ];
}