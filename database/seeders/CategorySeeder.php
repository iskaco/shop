<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::count() > 0)
            return;
        $categories = [
            [
                'name' => [
                    'en' => 'Shoe',
                    'ar' => __('categories.shoe'),
                ],
                'slug' => Str::slug('Shoe'),
                'description' => [
                    'en' => __('categories.descriptions.shoe'),
                    'ar' => __('categories.descriptions.shoe'),
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Electronics',
                    'ar' => __('categories.electronics'),
                ],
                'slug' => Str::slug('Electronics'),
                'description' => [
                    'en' => __('categories.descriptions.electronics'),
                    'ar' => __('categories.descriptions.electronics'),
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Bathroom',
                    'ar' => __('categories.bathroom'),
                ],
                'slug' => Str::slug('Bathroom'),
                'description' => [
                    'en' => __('categories.descriptions.bathroom'),
                    'ar' => __('categories.descriptions.bathroom'),
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'T-shirt',
                    'ar' => __('categories.tshirt'),
                ],
                'slug' => Str::slug('T-shirt'),
                'description' => [
                    'en' => __('categories.descriptions.tshirt'),
                    'ar' => __('categories.descriptions.tshirt'),
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Furniture',
                    'ar' => __('categories.furniture'),
                ],
                'slug' => Str::slug('Furniture'),
                'description' => [
                    'en' => __('categories.descriptions.furniture'),
                    'ar' => __('categories.descriptions.furniture'),
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Honey',
                    'ar' => __('categories.honey'),
                ],
                'slug' => Str::slug('Honey'),
                'description' => [
                    'en' => __('categories.descriptions.honey'),
                    'ar' => __('categories.descriptions.honey'),
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Home Tools',
                    'ar' => __('categories.home_tools'),
                ],
                'slug' => Str::slug('Home Tools'),
                'description' => [
                    'en' => __('categories.descriptions.home_tools'),
                    'ar' => __('categories.descriptions.home_tools'),
                ],
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}
