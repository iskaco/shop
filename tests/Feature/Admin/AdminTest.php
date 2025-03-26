<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(Admin::factory()->create(), 'admin');
    }

    /** @test */
    public function it_can_list_admins()
    {
        $admins = Admin::factory()->count(3)->create();

        $response = $this->get(route('admin.admins.index'));

        $response->assertStatus(200)
                ->assertInertia(fn ($page) => $page
                    ->component('Admins/Index')
                    ->has('data', 3)
                    ->has('data.0', fn ($page) => $page
                        ->has('id')
                        ->has('email')
                        ->has('username')
                        ->has('first_name')
                        ->has('last_name')
                        ->has('mobile')
                        ->has('enable')
                        ->etc()
                    )
                );
    }

    /** @test */
    public function it_can_create_admin()
    {
        $adminData = Admin::factory()->make()->toArray();
        $adminData['password'] = 'password';
        $adminData['password_confirmation'] = 'password';

        $response = $this->post(route('admin.admins.store'), $adminData);

        $response->assertRedirect()
                ->assertSessionHas('success');

        $this->assertDatabaseHas('admins', [
            'email' => $adminData['email'],
            'username' => $adminData['username'],
            'first_name' => $adminData['first_name'],
            'last_name' => $adminData['last_name'],
            'mobile' => $adminData['mobile'],
            'enable' => $adminData['enable'],
        ]);
    }

    /** @test */
    public function it_can_update_admin()
    {
        $admin = Admin::factory()->create();
        $updateData = [
            'email' => 'updated@example.com',
            'username' => 'updated_username',
            'first_name' => 'Updated',
            'last_name' => 'Name',
            'mobile' => '09123456789',
            'enable' => false,
        ];

        $response = $this->put(route('admin.admins.update', $admin), $updateData);

        $response->assertRedirect()
                ->assertSessionHas('success');

        $this->assertDatabaseHas('admins', [
            'id' => $admin->id,
            'email' => $updateData['email'],
            'username' => $updateData['username'],
            'first_name' => $updateData['first_name'],
            'last_name' => $updateData['last_name'],
            'mobile' => $updateData['mobile'],
            'enable' => $updateData['enable'],
        ]);
    }

    /** @test */
    public function it_can_delete_admin()
    {
        $admin = Admin::factory()->create();

        $response = $this->delete(route('admin.admins.destroy', $admin));

        $response->assertRedirect();

        $this->assertDatabaseMissing('admins', [
            'id' => $admin->id,
        ]);
    }

    /** @test */
    public function it_can_assign_roles_to_admin()
    {
        $admin = Admin::factory()->create();
        $roles = Role::factory()->count(3)->create();

        $response = $this->put(route('admin.admins.update', $admin), [
            'roles' => $roles->pluck('id')->toArray(),
        ]);

        $response->assertRedirect()
                ->assertSessionHas('success');

        $this->assertEquals($roles->count(), $admin->roles()->count());
        $this->assertTrue($admin->roles->contains($roles->first()));
    }

    /** @test */
    public function it_validates_required_fields_for_admin_creation()
    {
        $response = $this->post(route('admin.admins.store'), []);

        $response->assertSessionHasErrors([
            'email',
            'username',
            'password',
            'first_name',
            'last_name',
            'mobile',
        ]);
    }

    /** @test */
    public function it_validates_unique_email_and_username()
    {
        $existingAdmin = Admin::factory()->create();

        $response = $this->post(route('admin.admins.store'), [
            'email' => $existingAdmin->email,
            'username' => $existingAdmin->username,
            'password' => 'password',
            'password_confirmation' => 'password',
            'first_name' => 'Test',
            'last_name' => 'User',
            'mobile' => '09123456789',
        ]);

        $response->assertSessionHasErrors([
            'email',
            'username',
        ]);
    }
}