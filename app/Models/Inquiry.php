<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    protected $table = 'inquiries';
    protected $fillable = [
        'car_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'message',
        'source',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Get the car that the inquiry is about.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Mark inquiry as read.
     */
    public function markAsRead(): void
    {
        $this->update(['is_read' => true]);
    }
}
