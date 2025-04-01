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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained();

            // Core Data (Immutable Snapshot)
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2); // Price at purchase time
            $table->decimal('unit_cost', 10, 2)->nullable(); // For profit calculations

            // Calculated Fields
            $table->decimal('subtotal', 10, 2) // (unit_price * quantity)
                ->virtualAs('unit_price * quantity');

            // Metadata
            $table->json('options')->nullable(); // Size/color/customizations
            $table->timestamps();

            // Indexes
            $table->index('order_id');
            $table->index('product_id', 'product_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
