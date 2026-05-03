<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_description',
        'hero_bg_image',
        'mission_title',
        'mission_description',
        'mission_image',
        'vision_title',
        'vision_description',
        'vision_image',
        'experience_years',
        'stat_cars_sold',
        'stat_happy_clients',
        'stat_partner_dealers',
    ];
}
