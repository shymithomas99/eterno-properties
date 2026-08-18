<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Testimonial extends Model
{
    protected $fillable = [
        'resort_id',
        'customer_name',
        'customer_place',
        'customer_image',
        'title',
        'content',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }

    public function resort()
    {
        return $this->belongsTo(Resort::class);
    }
}
