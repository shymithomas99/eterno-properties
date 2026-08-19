<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPage extends Model
{

    protected $table = 'booking_page';
    protected $fillable = [
        'banner_title',
        'banner_description',
        'banner_image',
    ];
}
