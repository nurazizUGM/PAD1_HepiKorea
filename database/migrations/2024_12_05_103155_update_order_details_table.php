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
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('customer_phone')->nullable()->change();
            $table->text('customer_address')->nullable()->change();
            $table->string('province')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('postal_code')->nullable()->change();

            $table->string('customer_email')->nullable()->after('customer_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('customer_email');
        });
    }
};
