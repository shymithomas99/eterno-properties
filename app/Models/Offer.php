<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Offer extends Model
{
    protected $fillable = [
        'type',
        'resort_id',
        'title',
        'description',
        'content',
        'image',
        'button_text',
        'button_url',
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
