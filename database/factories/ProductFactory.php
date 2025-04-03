<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = Category::exists() ? Category::inRandomOrder()->first(): Category::factory();
        $name = $this->faker->unique()->words(
            $this->faker->numberBetween(1, 4),
            true
        );

        return [
            'category_id' => $category->id,
            'brand_id' => $this->faker->optional(70, null)->randomElement(Brand::pluck('id')->toArray()),
            'name' => $name,
            'slug' => Str::slug($name),
            'short_description' => $this->faker->sentence(10),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock' => $this->faker->numberBetween(0, 500),
            'is_published' => $this->faker->boolean(80),
            'is_featured' => $this->faker->boolean(20),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    // حالت‌های خاص (State)
    public function published()
    {
        return $this->state([
            'is_published' => true,
        ]);
    }

    public function unpublished()
    {
        return $this->state([
            'is_published' => false,
        ]);
    }

    public function featured()
    {
        return $this->state([
            'is_featured' => true,
        ]);
    }

    public function outOfStock()
    {
        return $this->state([
            'stock' => 0,
        ]);
    }

    public function withCategory($categoryId)
    {
        return $this->state([
            'category_id' => $categoryId,
        ]);
    }

    public function withBrand($brandId)
    {
        return $this->state([
            'brand_id' => $brandId,
        ]);
    }

    public function withSpecificName(string $name)
    {
        return $this->state([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
    }

    public function withPrice(float $price)
    {
        return $this->state([
            'price' => $price,
        ]);
    }
}
