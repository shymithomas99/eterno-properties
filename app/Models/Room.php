<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'type',
        'name',
        'slug',
        'description',
        'main_image',
        'bed_type',
        'guests',
        'size',
        'view',
        'booking_url',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }

    // protected $casts = [
    //     'status' => 'boolean',
    //     'guests' => 'integer',
    //     'sort_order' => 'integer',
    // ];

    // public function galleryImages(): HasMany
    // {
    //     return $this->hasMany(RoomGallery::class)
    //         ->orderBy('sort_order');
    // }


    public function galleryImages()
    {
        return $this->hasMany(RoomGallery::class, 'room_id', 'id');
    }
}
