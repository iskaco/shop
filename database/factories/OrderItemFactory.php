<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = Product::exists() ? Product::inRandomOrder()->first() : Product::factory()->create();
        $order = Order::exists() ? Order::inRandomOrder()->first() : Order::factory();
        $quantity = $this->faker->numberBetween(1, 5);
        $unitPrice = $this->faker->randomFloat(2, 10, 500);
        $unitCost = $this->faker->randomFloat(2, 5, $unitPrice * 0.8); // 80% of price as max cost

        return [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'unit_cost' => $unitCost,
            'options' => $this->generateOptions($product),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    protected function generateOptions($product)
    {
        $options = [];

        // 50% chance to have color option
        if ($this->faker->boolean(50)) {
            $options['color'] = $this->faker->randomElement(['Red', 'Blue', 'Black', 'White']);
        }

        // 30% chance to have size option
        if ($this->faker->boolean(30)) {
            $options['size'] = $this->faker->randomElement(['S', 'M', 'L', 'XL']);
        }

        // 20% chance to have custom text
        if ($this->faker->boolean(20)) {
            $options['custom_text'] = $this->faker->words(3, true);
        }

        return !empty($options) ? json_encode($options) : null;
    }

    // حالت‌های خاص (State)
    public function withOrder($orderId)
    {
        return $this->state([
            'order_id' => $orderId,
        ]);
    }

    public function withProduct($productId)
    {
        return $this->state([
            'product_id' => $productId,
        ]);
    }

    public function withQuantity($quantity)
    {
        return $this->state([
            'quantity' => $quantity,
        ]);
    }

    public function withUnitPrice($price)
    {
        return $this->state([
            'unit_price' => $price,
        ]);
    }

    public function withSpecificOptions(array $options)
    {
        return $this->state([
            'options' => $options,
        ]);
    }

    public function withDiscount($discountPercent)
    {
        return $this->state(function (array $attributes) use ($discountPercent) {
            $discountedPrice = $attributes['unit_price'] * (1 - ($discountPercent / 100));

            return [
                'unit_price' => round($discountedPrice, 2),
            ];
        });
    }
}
