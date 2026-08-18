<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmenityCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'status',
    ];

    // public function amenities()
    // {
    //     return $this->belongsTo(Amenity::class);
    // }

    public function amenities()
    {
        return $this->hasMany(Amenity::class, 'amenity_category_id', 'id');
    }
}