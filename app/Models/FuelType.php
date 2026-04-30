<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FuelType extends Model
{
    protected $table = 'fuel_types';
    protected $fillable = ['name', 'slug'];
    public $timestamps = true;

    /**
     * Get the cars for the fuel type.
     */
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
