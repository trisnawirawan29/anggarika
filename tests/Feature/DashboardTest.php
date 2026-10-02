<?php

namespace Tests\Feature;

use App\Models\InvitationGuest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_dashboard_displays_rsvp_counts(): void
    {
        $user = User::factory()->create();
        InvitationGuest::factory()->create(['rsvp_status' => 'attending']);
        InvitationGuest::factory()->create(['rsvp_status' => 'declined']);
        InvitationGuest::factory()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk()
            ->assertSee('Total Tamu Undangan')
            ->assertSee('Hadir')
            ->assertSee('Tidak hadir')
            ->assertSee('3')
            ->assertSee('1');
    }

    public function test_dashboard_filter_displays_the_selected_rsvp_guest_list(): void
    {
        $user = User::factory()->create();
        InvitationGuest::factory()->create(['name' => 'Tamu Hadir', 'rsvp_status' => 'attending']);
        InvitationGuest::factory()->create(['name' => 'Tamu Tidak Hadir', 'rsvp_status' => 'declined']);

        $response = $this->actingAs($user)->get(route('dashboard', ['rsvp' => 'attending']));

        $response->assertOk()
            ->assertSee('Daftar tamu yang hadir')
            ->assertSee('Tamu Hadir')
            ->assertDontSee('Tamu Tidak Hadir');
    }
}
