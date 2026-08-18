<?php

namespace App\Models;
use App\Enums\Status;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'type',
        'resort_id',
        'gallery_category_id',
        'image',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }

    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function resort()
    {
        return $this->belongsTo(Resort::class, 'resort_id');
    }
}
