<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id')->onDelete('cascade');
            $table->foreignId('farmer_id')->nullable()->constrained('farmer_profiles', 'farmer_id')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->text('farmer_reply')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};