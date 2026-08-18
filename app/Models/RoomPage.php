<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomPage extends Model
{
    protected $table = 'room_page';

    protected $fillable = [
        'banner_title',
        'banner_description',
        'banner_image',
    ];
}