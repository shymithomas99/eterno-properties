<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class WelcomeSection extends Model
{
    protected $fillable = [
        'sub_title',
        'title',
        'description',
        'left_image',
        'right_image',
        'button_text',
        'button_url',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
}
