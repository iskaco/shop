<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => [
                'en' => $this->faker->unique()->word(),
                'fa' => $this->faker->unique()->word(),
            ],
            'guard_name' => 'admin',
        ];
    }

    /**
     * Indicate that the role is super admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function superAdmin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => [
                    'en' => 'Super Admin',
                    'fa' => 'مدیر کل',
                ],
                'guard_name' => 'admin',
            ];
        });
    }
}
