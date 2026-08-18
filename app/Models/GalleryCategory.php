<?php

namespace App\Models;
use App\Enums\Status;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $fillable = [
        'name',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
