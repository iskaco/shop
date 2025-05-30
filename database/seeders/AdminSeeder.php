<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (Admin::where('username', 'admin')->first())
            return;
        Admin::firstOrCreate(
            [
                'username' => 'admin',
                'email' => 'admin@meemhome.com',
                'first_name' => 'admin',
                'last_name' => 'admin',
                'password' => 'meemhome@admin',
            ]
        );
    }
}
