<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->string('customer_name')->nullable();
            $table->string('phone', 20);
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->enum('status', ['pending', 'paid', 'cancelled', 'expired'])->default('pending');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['car_id', 'status']);
            $table->index(['status', 'expires_at']); // For the expiry scheduler query
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
