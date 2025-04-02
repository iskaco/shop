<?php

namespace Database\Factories;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // 70% chance to have a user, 30% guest cart
        $hasUser = $this->faker->boolean(70);
        
        return [
            'user_id' => $hasUser ? User::factory() : null,
            'session_id' => $hasUser ? null : Str::random(40),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    // حالت‌های خاص (State)
    public function forUser($userId)
    {
        return $this->state([
            'user_id' => $userId,
            'session_id' => null,
        ]);
    }

    public function forGuest()
    {
        return $this->state([
            'user_id' => null,
            'session_id' => Str::random(40),
        ]);
    }

    public function withSession($sessionId)
    {
        return $this->state([
            'user_id' => null,
            'session_id' => $sessionId,
        ]);
    }

    public function withItems($count = 3)
    {
        return $this->afterCreating(function ($cart) use ($count) {
            CartItem::factory()
                ->count($count)
                ->for($cart)
                ->create();
        });
    }

}
