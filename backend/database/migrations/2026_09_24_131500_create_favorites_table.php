<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id')->onDelete('cascade');
            $table->foreignId('farmer_id')->nullable()->constrained('farmer_profiles', 'farmer_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};