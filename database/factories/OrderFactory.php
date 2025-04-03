<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::exists() ? User::inRandomOrder()->first() : User::factory();
        $subtotal = $this->faker->randomFloat(2, 50, 1000);
        $taxRate = 0.1; // 10% tax
        $taxAmount = round($subtotal * $taxRate, 2);
        $discountAmount = $this->faker->randomFloat(2, 0, $subtotal * 0.3); // Max 30% discount
        $shippingCost = $this->faker->randomFloat(2, 0, 50);
        $total = $subtotal + $taxAmount + $shippingCost - $discountAmount;

        return [
            'user_id' => $user->id,
            'status' => $this->faker->randomElement(Order::STATUSES),
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'payment_method' => $this->faker->randomElement([
                'credit_card',
                'paypal',
                'bank_transfer',
                'cash_on_delivery'
            ]),
            'shipping_address' => $this->faker->address,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),

        ];
    }
    public function withDiscount(float $amount)
    {
        return $this->state(function (array $attributes) use ($amount) {
            $newTotal = $attributes['subtotal'] + $attributes['tax_amount'] 
                      + $attributes['shipping_cost'] - $amount;
            
            return [
                'discount_amount' => $amount,
                'total' => max(0, $newTotal), // Ensure total doesn't go negative
            ];
        });
    }

    public function freeShipping()
    {
        return $this->state([
            'shipping_cost' => 0,
        ]);
    }

    public function withItems($count = 3)
    {
        return $this->afterCreating(function ($order) use ($count) {
            OrderItem::factory()
                ->count($count)
                ->for($order)
                ->create();
        });
    }

}
