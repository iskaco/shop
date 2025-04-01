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
        ]);
    }
}
