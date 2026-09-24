<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->id('market_id');
            $table->string('market_name', 100);
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('map_provider', 30)->default('openstreetmap');
            $table->string('operating_days', 100)->nullable(); // e.g. "Mon,Wed,Fri"
            $table->string('timings', 100)->nullable(); // e.g. "6AM-12PM"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};