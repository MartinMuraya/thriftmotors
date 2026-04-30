<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'customer_name',
        'phone',
        'amount_paid',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'expires_at'  => 'datetime',
        'amount_paid' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function latestPayment(): HasOne
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }

    public function daysRemaining(): int
    {
        if (! $this->expires_at) {
            return 0;
        }

        return max(0, (int) now()->diffInDays($this->expires_at, false));
    }
}
