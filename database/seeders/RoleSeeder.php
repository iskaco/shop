<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (Role::count() > 0)
            return;
        Role::firstOrCreate(['name' => ['en' => 'admin',  'ar' => __('titles.admin')], 'guard_name' => 'admin']);
        Role::firstOrCreate(['name' => ['en' => 'manager',  'ar' => __('titles.manager')], 'guard_name' => 'admin']);
        Role::firstOrCreate(['name' => ['en' => 'staff',  'ar' => __('titles.staff')], 'guard_name' => 'admin']);
    }
}
