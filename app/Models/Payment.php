<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'reservation_id',
        'mpesa_receipt',
        'amount',
        'status',
        'raw_callback',
        'checkout_request_id',
        'merchant_request_id',
    ];

    protected $casts = [
        'raw_callback' => 'array',
        'amount'       => 'decimal:2',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}
