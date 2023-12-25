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
            $table->foreignId('user_id');
            $table->integer('order_id');
            $table->foreignId('type');
            $table->foreignId('from_id');
            $table->foreignId('to_id');
            $table->string('from_type');
            $table->string('to_type');
            $table->decimal('amount',8,2);
            $table->decimal('balance',8,2);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
