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
        $status = ['unconfirmed', 'confirmed', 'unpaid', 'paid', 'processing', 'shipment_unpaid', 'shipment_paid', 'sending', 'sent', 'finished', 'cancelled'];
        Schema::create('orders', function (Blueprint $table) use ($status) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->integer('total_items_price');
            $table->integer('service_price')->default(0);
            $table->enum('status', $status)->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
