<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transmission extends Model
{
    protected $fillable = ['name', 'slug'];

    /**
     * Get the cars for the transmission.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
