<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'logo_url'];

    /**
     * Get the cars for the brand.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
