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
        Schema::create('custom_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'id')->cascadeOnDelete();
            $table->string('name');
            $table->string('url');
            $table->text('description');
            $table->integer('quantity');
            $table->integer('estimated_price');
            $table->integer('total_price')->nullable();
            $table->boolean('is_available')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_order_items');
    }
};
