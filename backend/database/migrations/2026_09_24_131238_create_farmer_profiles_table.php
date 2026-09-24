<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id('farmer_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('stall_name', 100);
            $table->string('contact_person', 100);
            $table->text('description')->nullable();
            $table->foreignId('market_id')->nullable()->constrained('markets', 'market_id')->onDelete('set null');
            $table->string('operating_days', 100)->nullable();
            $table->string('pickup_window', 100)->nullable(); // e.g. "7AM-11AM"
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->time('order_cutoff_time')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farmer_profiles');
    }
};