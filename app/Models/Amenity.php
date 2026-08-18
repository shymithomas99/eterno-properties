<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = [
        'amenity_category_id',
        'name',
        // 'sort_order',
        // 'status',
    ];



    public function category()
    {
        return $this->belongsTo(AmenityCategory::class, 'amenity_category_id', 'id');
    }
}