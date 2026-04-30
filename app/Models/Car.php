<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Car extends Model
{
    protected $fillable = [
        'brand_id',
        'fuel_type_id',
        'transmission_id',
        'title',
        'slug',
        'description',
        'year',
        'price',
        'is_negotiable',
        'mileage',
        'color',
        'seats',
        'features',
        'seller_name',
        'seller_phone',
        'seller_whatsapp',
        'is_featured',
        'is_hot_deal',
        'is_active',
        'is_for_hire',
        'featured_until',
        'status',
    ];

    protected $casts = [
        'features'      => 'array',
        'is_negotiable' => 'boolean',
        'is_featured'   => 'boolean',
        'is_hot_deal'   => 'boolean',
        'is_active'     => 'boolean',
        'is_for_hire'   => 'boolean',
        'featured_until'=> 'datetime',
    ];

    /**
     * Get the brand that owns the car.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the fuel type that owns the car.
     */
    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }

    /**
     * Get the transmission that owns the car.
     */
    public function transmission(): BelongsTo
    {
        return $this->belongsTo(Transmission::class);
    }

    /**
     * Get the images for the car.
     */
    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class)->orderBy('sort_order');
    }

    /**
     * Get the inquiries for the car.
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function activeReservation()
    {
        return $this->hasOne(Reservation::class)->whereIn('status', ['pending', 'paid']);
    }

    public function isReserved(): bool
    {
        return $this->status === 'reserved';
    }

    public function isSold(): bool
    {
        return $this->status === 'sold';
    }

    /**
     * Get the primary image for the car.
     */
    public function primaryImage()
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
    }

    /**
     * Get the featured label.
     */
    public function getStatusBadgeAttribute(): ?string
    {
        if ($this->is_hot_deal) {
            return 'Hot Deal';
        }
        if ($this->is_featured) {
            return 'Featured';
        }
        return null;
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title . '-' . uniqid());
            }
        });
    }
}
