<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class TestimonialIntro extends Model
{
    protected $fillable = [
        'sub_title',
        'title',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
}
