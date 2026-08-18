<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomGallery extends Model
{
    protected $fillable = [
        'room_id',
        'image',
        // 'sort_order',
    ];

    // protected $casts = [
    //     'sort_order' => 'integer',
    // ];


    public function resort()
    {
        return $this->belongsTo(Room::class);
    }
}