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
        Schema::create('order_logs', function (Blueprint $table) use ($status) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders', 'id')->cascadeOnDelete();
            $table->enum('status', $status);
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_logs');
    }
};