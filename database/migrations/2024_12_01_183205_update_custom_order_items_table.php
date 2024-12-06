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
        Schema::table('custom_order_items', function (Blueprint $table) {
            $table->timestamp('available_until')->nullable()->after('is_available');
            $table->integer('max_quantity')->nullable()->after('available_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_order_items', function (Blueprint $table) {
            $table->dropColumn('available_until');
            $table->dropColumn('max_quantity');
        });
    }
};
