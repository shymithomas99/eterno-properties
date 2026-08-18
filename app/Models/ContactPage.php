<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactPage extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'banner_title',
        'banner_description',
        'banner_image',
        'section_subtitle',
        'section_title',
        'section_description',
        'form_title',
        'form_description',
        'form_image',
        // Contact Details
        'phone',
        'phone_1',
        'phone_2',
        'phone_3',
        'email',
        'email_1',
        'email_2',
        'address',
        'address_1',
        'map_iframe',
        // Social Media
        'twitter_url',
        'youtube_url',
        'instagram_url',
        'facebook_url',
    ];
}