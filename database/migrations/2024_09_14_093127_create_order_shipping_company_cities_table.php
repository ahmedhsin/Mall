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
        Schema::create('order_shipping_company_cities', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->foreignId('shipping_company_id')->constrained('shipping_companies')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('order_id')->constrained('orders')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('price_premium', 10, 2);
            $table->decimal('price_normal', 10, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_shipping_company_cities');
    }
};
