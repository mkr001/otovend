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
        Schema::table('products', function (Blueprint $table) {
            $table->index('category');
            $table->index('condition');
            $table->index(['vendor_id', 'created_at']); // Fast sorting by vendor
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('status');
            $table->index('created_at');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->index(['product_id', 'order_id']); // Joint query optimization
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropIndex(['condition']);
            $table->dropIndex(['vendor_id', 'created_at']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['product_id', 'order_id']);
        });
    }
};
