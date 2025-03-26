<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => [
                    'en' => 'Shoe',
                    'fa' => __('categories.shoe'),
                    'ar' => __('categories.shoe')
                ],
                'slug' => Str::slug('Shoe'),
                'description' => [
                    'en' => __('categories.descriptions.shoe'),
                    'fa' => __('categories.descriptions.shoe'),
                    'ar' => __('categories.descriptions.shoe')
                ]
            ],
            [
                'name' => [
                    'en' => 'Electronics',
                    'fa' => __('categories.electronics'),
                    'ar' => __('categories.electronics')
                ],
                'slug' => Str::slug('Electronics'),
                'description' => [
                    'en' => __('categories.descriptions.electronics'),
                    'fa' => __('categories.descriptions.electronics'),
                    'ar' => __('categories.descriptions.electronics')
                ]
            ],
            [
                'name' => [
                    'en' => 'Bathroom',
                    'fa' => __('categories.bathroom'),
                    'ar' => __('categories.bathroom')
                ],
                'slug' => Str::slug('Bathroom'),
                'description' => [
                    'en' => __('categories.descriptions.bathroom'),
                    'fa' => __('categories.descriptions.bathroom'),
                    'ar' => __('categories.descriptions.bathroom')
                ]
            ],
            [
                'name' => [
                    'en' => 'T-shirt',
                    'fa' => __('categories.tshirt'),
                    'ar' => __('categories.tshirt')
                ],
                'slug' => Str::slug('T-shirt'),
                'description' => [
                    'en' => __('categories.descriptions.tshirt'),
                    'fa' => __('categories.descriptions.tshirt'),
                    'ar' => __('categories.descriptions.tshirt')
                ]
            ],
            [
                'name' => [
                    'en' => 'Furniture',
                    'fa' => __('categories.furniture'),
                    'ar' => __('categories.furniture')
                ],
                'slug' => Str::slug('Furniture'),
                'description' => [
                    'en' => __('categories.descriptions.furniture'),
                    'fa' => __('categories.descriptions.furniture'),
                    'ar' => __('categories.descriptions.furniture')
                ]
            ],
            [
                'name' => [
                    'en' => 'Honey',
                    'fa' => __('categories.honey'),
                    'ar' => __('categories.honey')
                ],
                'slug' => Str::slug('Honey'),
                'description' => [
                    'en' => __('categories.descriptions.honey'),
                    'fa' => __('categories.descriptions.honey'),
                    'ar' => __('categories.descriptions.honey')
                ]
            ],
            [
                'name' => [
                    'en' => 'Home Tools',
                    'fa' => __('categories.home_tools'),
                    'ar' => __('categories.home_tools')
                ],
                'slug' => Str::slug('Home Tools'),
                'description' => [
                    'en' => __('categories.descriptions.home_tools'),
                    'fa' => __('categories.descriptions.home_tools'),
                    'ar' => __('categories.descriptions.home_tools')
                ]
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
