<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resort extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'url',
        'sort_order',
        'home_place',
        'home_title',
        'home_description',
        'home_image',
        'home_button_text',
        'home_status',
        'home_updated_at',
        'mega_menu_sub_title',
        'mega_menu_title',
        'mega_menu_description',
        'mega_menu_image',
        'mega_menu_status',
        'mega_menu_updated_at',
        'book_now_image',
        'book_now_status',
        'book_now_updated_at'
    ];

    protected function casts(): array
    {
        return [
            'home_status' => Status::class,
            'mega_menu_status' => Status::class,
            'book_now_status' => Status::class,
            'home_updated_at' => 'datetime',
            'mega_menu_updated_at' => 'datetime',
            'book_now_updated_at' => 'datetime',
        ];
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
