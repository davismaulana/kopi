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
        Schema::table('payment_transaction', function (Blueprint $table) {
            $table->unsignedInteger('count')->default(1); // Add count column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transaction', function (Blueprint $table) {
            $table->dropColumn('count');
        });
    }
};
