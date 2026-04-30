<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarImage extends Model
{
    protected $table = 'car_images';
    protected $fillable = [
        'car_id',
        'image_url',
        'image_path',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the car that owns the image.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
