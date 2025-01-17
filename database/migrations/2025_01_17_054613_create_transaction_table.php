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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customer')->onDelete('cascade');
            $table->foreignId('food_id')->constrained('food')->onDelete('cascade');
            $table->foreignId('drink_id')->constrained('drink')->onDelete('cascade');
            $table->integer('food_total');
            $table->integer('drink_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
