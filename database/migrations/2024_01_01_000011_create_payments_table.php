<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->cascadeOnDelete();
            $table->string('mpesa_receipt', 20)->nullable()->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->json('raw_callback')->nullable(); // Full M-Pesa payload for audit
            $table->string('checkout_request_id')->nullable()->index(); // For callback matching
            $table->string('merchant_request_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
