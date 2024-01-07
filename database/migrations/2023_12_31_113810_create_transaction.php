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
            $table->foreignId('user_id')->constrained('users','id');
            $table->foreignId('order_id')->constrained('orders','id');
            $table->foreignId('type')->constrained('transaction_types');
            $table->string('fromable_account_type');
            $table->unsignedBigInteger('fromable_account_id');
            $table->string('toable_account_type');
            $table->unsignedBigInteger('toable_account_id');
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
