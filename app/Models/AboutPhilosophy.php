<?php

namespace App\Models;

use App\Enums\AboutStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutPhilosophy extends Model
{

    use SoftDeletes;

    protected $fillable = [

        'title',
        'description',
        'icon_image',
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