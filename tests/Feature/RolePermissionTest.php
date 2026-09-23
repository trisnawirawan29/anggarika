<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_open_administration_menu(): void
    {
        $role = Role::where('slug', 'user')->firstOrFail();
        $user = User::factory()->create(['role' => 'user', 'role_id' => $role->id]);

        $this->actingAs($user)->get('/admin/users')->assertForbidden();
    }

    public function test_admin_can_open_administration_menu(): void
    {
        $role = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $role->id]);

        $this->actingAs($admin)->get('/admin/users')->assertOk();
    }

    public function test_only_superadmin_can_assign_superadmin_role(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);
        $target = User::factory()->create(['role' => 'user', 'role_id' => Role::where('slug', 'user')->value('id')]);
        $superadminRoleId = Role::where('slug', 'superadmin')->value('id');

        $this->actingAs($admin)->put(route('admin.users.role', $target), ['role_id' => $superadminRoleId])->assertForbidden();
    }

    public function test_logged_in_user_cannot_delete_themselves(): void
    {
        $role = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $role->id]);

        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $admin))
            ->assertRedirect()
            ->assertSessionHasErrors(['user' => 'Anda tidak dapat menghapus akun sendiri.']);

        $this->assertModelExists($admin);
    }
}
