<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cart_id' => Cart::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }

    public function forCart($cartId)
    {
        return $this->state([
            'cart_id' => $cartId,
        ]);
    }

    public function forProduct($productId)
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

    public function withProductData($productData)
    {
        return $this->afterCreating(function ($cartItem) use ($productData) {
            $cartItem->product()->update($productData);
        });
    }

}
