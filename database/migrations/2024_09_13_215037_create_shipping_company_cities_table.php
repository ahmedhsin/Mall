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
        Schema::create('shipping_company_cities', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->foreignId('shipping_company_id')->constrained('shipping_companies')->
            cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->decimal('price_premium', 10, 2);
            $table->decimal('price_normal', 10, 2);

            $table->json('premium_description');
            $table->json('normal_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_company_cities');
    }
};
