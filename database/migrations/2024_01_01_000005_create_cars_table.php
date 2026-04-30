<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('fuel_type_id')->constrained('fuel_types')->onDelete('cascade');
            $table->foreignId('transmission_id')->constrained('transmissions')->onDelete('cascade');
            
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('year');
            $table->decimal('price', 12, 2);
            $table->boolean('is_negotiable')->default(false);
            $table->integer('mileage'); // in km
            $table->string('color');
            $table->integer('seats')->default(5);
            $table->text('features')->nullable(); // JSON array
            
            $table->string('seller_name');
            $table->string('seller_phone');
            $table->string('seller_whatsapp')->nullable();
            
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_active')->default(true);
            
            $table->timestamp('featured_until')->nullable();
            $table->timestamps();
            
            $table->index('brand_id');
            $table->index('fuel_type_id');
            $table->index('transmission_id');
            $table->index('is_active');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
