<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->company;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(3),
            'short_description' => $this->faker->sentence(10),
            'is_active' => $this->faker->boolean(70), // 70% احتمال فعال بودن
            'is_featured' => $this->faker->boolean(20), // 20% احتمال ویژه بودن
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
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

    public function withLogo()
    {
        return $this->state([
            'logo_path' => 'brands/logos/'.$this->faker->uuid.'.png',
        ]);
    }

    public function withSpecificName(string $name)
    {
        return $this->state([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
    }

}
