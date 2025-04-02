<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(
            $this->faker->numberBetween(1, 3),
            true
        );

        return [
            'name' => $name,
            'parent_id' => null,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph,
            'icon' => $this->faker->randomElement([
                'fa-box', 
                'fa-tag', 
                'fa-cube', 
                'fa-shopping-bag',
                'fa-tshirt',
                null
            ]),
            'is_active' => $this->faker->boolean(80), // 80% احتمال فعال بودن
            'is_featured' => $this->faker->boolean(30), // 30% احتمال ویژه بودن
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    // حالت‌های خاص (State)
    public function active()
    {
        return $this->state([
            'is_active' => true,
        ]);
    }

    public function inactive()
    {
        return $this->state([
            'is_active' => false,
        ]);
    }

    public function featured()
    {
        return $this->state([
            'is_featured' => true,
        ]);
    }

    public function withParent()
    {
        return $this->state(function (array $attributes) {
            $parent = Category::factory()->create();
            
            return [
                'parent_id' => $parent->id,
            ];
        });
    }

    public function withChildren($count = 3)
    {
        return $this->afterCreating(function (Category $category) use ($count) {
            Category::factory()
                ->count($count)
                ->state(['parent_id' => $category->id])
                ->create();
        });
    }

}
