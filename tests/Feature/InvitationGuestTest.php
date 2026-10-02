<?php

namespace Tests\Feature;

use App\Models\InvitationGuest;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationGuestTest extends TestCase
{
    use RefreshDatabase;

    public function test_personal_invitation_displays_guest_details_and_unique_link(): void
    {
        $guest = InvitationGuest::factory()->create(['name' => 'Budi Santoso']);

        $response = $this->get(route('invitation', $guest));

        $response->assertSee('Kepada Yth.');
        $response->assertSee('Budi Santoso');
        $response->assertSee('Mohon maaf apabila ada kesalahan penulisan nama/alamat.');
    }

    public function test_inactive_invitation_cannot_be_opened(): void
    {
        $guest = InvitationGuest::factory()->create(['is_active' => false]);

        $this->get(route('invitation', $guest))->assertNotFound();
    }

    public function test_admin_can_add_an_invitation_guest(): void
    {
        $role = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $role->id]);

        $response = $this->actingAs($admin)->post(route('admin.invitation-guests.store'), [
            'name' => 'Siti Aminah',
            'phone' => '08123456789',
            'is_active' => '1',
        ]);

        $guest = InvitationGuest::query()->where('name', 'Siti Aminah')->firstOrFail();

        $response->assertRedirect(route('admin.invitation-guests.index'));
        $this->assertModelExists($guest);
        $this->assertSame('siti-aminah', $guest->slug);
    }

    public function test_admin_can_view_the_invitation_guest_list(): void
    {
        $role = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $role->id]);
        InvitationGuest::factory()->create(['name' => 'Rina Wijaya']);

        $this->actingAs($admin)
            ->get(route('admin.invitation-guests.index'))
            ->assertOk()
            ->assertSee('Rina Wijaya')
            ->assertSee('Salin pesan WhatsApp', false);
    }

    public function test_admin_can_update_personal_invitation_settings_from_guest_menu(): void
    {
        $role = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $role->id]);

        $response = $this->actingAs($admin)->put(route('admin.landing-settings.update'), [
            'save_section' => 'hero',
            'landing_section_hero' => '0',
            'landing_guest_greeting' => 'Kepada Bapak/Ibu',
            'landing_guest_apology' => 'Mohon maaf atas kekurangan kami.',
            'landing_guest_message_template' => 'Halo {{nama}}, buka {{link}}.',
        ]);

        $response->assertRedirect()->assertSessionDoesntHaveErrors();
        $this->assertSame('Kepada Bapak/Ibu', Setting::query()->where('key', 'landing_guest_greeting')->value('value'));
        $this->assertSame('Halo {{nama}}, buka {{link}}.', Setting::query()->where('key', 'landing_guest_message_template')->value('value'));
    }

    public function test_guest_names_receive_different_slugs(): void
    {
        $first = InvitationGuest::factory()->create(['name' => 'Dewi Lestari']);
        $second = InvitationGuest::factory()->create(['name' => 'Dewi Lestari']);

        $this->assertSame('dewi-lestari', $first->slug);
        $this->assertSame('dewi-lestari-2', $second->slug);
    }
}
