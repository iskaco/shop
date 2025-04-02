<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (Brand::count() > 0)
            return;
        Brand::firstOrCreate([
            'name' => [
                'en' => 'Nike',
                'ar' => __('brands.nike'),
            ],
            'slug' => 'nike',
            'description' => [
                'en' => __('brands.descriptions.nike'),
                'ar' => __('brands.descriptions.nike'),
            ],
            'is_active' => true,
        ]);
        Brand::firstOrCreate([
            'name' => [
                'en' => 'Adidas',
                'ar' => __('brands.adidas'),
            ],
            'slug' => 'adidas',
            'description' => [
                'en' => __('brands.descriptions.adidas'),
                'ar' => __('brands.descriptions.adidas'),
            ],
            'is_active' => true,
        ]);
        Brand::firstOrCreate([
            'name' => [
                'en' => 'Puma',
                'ar' => __('brands.puma'),
            ],
            'slug' => 'puma',
            'description' => [
                'en' => __('brands.descriptions.puma'),
                'ar' => __('brands.descriptions.puma'),
            ],
            'is_active' => true,
        ]);
        Brand::firstOrCreate([
            'name' => [
                'en' => 'Reebok',
                'ar' => __('brands.reebok'),
            ],
            'slug' => 'reebok',
            'description' => [
                'en' => __('brands.descriptions.reebok'),
                'ar' => __('brands.descriptions.reebok'),
            ],
            'is_active' => true,
        ]);
        Brand::firstOrCreate([
            'name' => [
                'en' => 'Under Armour',
                'ar' => __('brands.under_armour'),
            ],
            'slug' => 'under-armour',
            'description' => [
                'en' => __('brands.descriptions.under_armour'),
                'ar' => __('brands.descriptions.under_armour'),
            ],
            'is_active' => true,
        ]);
    }
}
