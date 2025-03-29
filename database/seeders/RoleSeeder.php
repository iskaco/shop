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
        Role::create(['name' => ['en' => 'admin',  'ar' => __('titles.admin')], 'guard_name' => 'admin']);
        Role::create(['name' => ['en' => 'manager',  'ar' => __('titles.manager')], 'guard_name' => 'admin']);
        Role::create(['name' => ['en' => 'staff',  'ar' => __('titles.staff')], 'guard_name' => 'admin']);
    }
}
