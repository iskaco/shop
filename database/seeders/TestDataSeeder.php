<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new DatabaseSeeder)?->run();
        (new ProductSeeder)?->run();
        (new CartSeeder)?->run();
        (new OrderSeeder)?->run();
    }
}
