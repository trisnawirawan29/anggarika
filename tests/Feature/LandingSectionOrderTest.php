<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LandingSectionOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_save_landing_section_order(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);
        $order = ['hero', 'story', 'couple', 'countdown', 'cta', 'event', 'people', 'cta_gallery', 'gallery', 'rsvp', 'gta', 'gift', 'footer', 'music'];

        $response = $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'order',
                'landing_section_order' => json_encode($order),
            ])
            ->assertRedirect();

        $this->assertSame($order, json_decode((string) Setting::value('landing_section_order'), true));
    }

    public function test_landing_page_renders_sections_in_saved_order(): void
    {
        $order = ['hero', 'story', 'couple', 'countdown', 'cta', 'event', 'people', 'cta_gallery', 'gallery', 'rsvp', 'gta', 'gift', 'footer', 'music'];
        Setting::updateOrCreate(['key' => 'landing_section_order'], ['value' => json_encode($order)]);

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringContainsString('["hero","story","couple"', $content);
    }

    public function test_admin_can_upload_mp3_file(): void
    {
        Storage::fake('public');
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->post(route('admin.landing-settings.photo'), [
                'photo_key' => 'landing_music_file',
                'photo' => UploadedFile::fake()->create('wedding.mp3', 100, 'audio/mpeg'),
            ])
            ->assertOk()
            ->assertJsonStructure(['url']);

        Storage::disk('public')->assertExists((string) Setting::value('landing_music_file'));
    }
}
