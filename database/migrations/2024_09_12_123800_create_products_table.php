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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->foreignId('store_id')->constrained('stores')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->json('name');
            $table->json('description');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('sku')->unique();
            $table->decimal('weight', 8, 2)->nullable();
            $table->text('dimensions')->nullable();
            $table->boolean('featured')->default(false);
            $table->json('brand');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
