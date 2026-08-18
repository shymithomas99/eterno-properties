<?php

namespace App\Models;

use App\Enums\AboutStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutCoreValue extends Model
{


    use SoftDeletes;

    protected $fillable = [

        'title',

        'description',

        'sort_order',

        'status'
    ];

    protected function casts(): array
    {
        return [
            'status' => AboutStatus::class,
        ];
    }
}