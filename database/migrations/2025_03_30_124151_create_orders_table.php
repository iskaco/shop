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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['pending', 'paid', 'shipped', 'cancelled']);
            
            // Pricing (Denormalized for performance/auditing)
            $table->decimal('subtotal', 10, 2); // Sum of order items (before tax/discounts)
            $table->decimal('tax_amount', 10, 2); // Calculated tax (e.g., 10% of subtotal)
            $table->decimal('discount_amount', 10, 2)->default(0); // Order-level discounts
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('total', 10, 2); // Final total (subtotal + tax + shipping - discount)
            
            // Metadata
            $table->string('payment_method');
            $table->text('shipping_address');
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
