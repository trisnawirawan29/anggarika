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

    public function test_admin_can_configure_each_event_and_hide_disabled_events(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);
        $events = [];

        foreach (range(1, 4) as $number) {
            $isEnabled = $number !== 2;
            $events[
                'landing_event_'.$number.'_enabled'
            ] = $isEnabled ? '1' : '0';
            $locationIsEnabled = $isEnabled && $number !== 1;
            $events['landing_event_'.$number.'_location_enabled'] = $locationIsEnabled ? '1' : '0';
            $events['landing_event_'.$number.'_title'] = $isEnabled ? 'Acara '.$number : '';
            $events['landing_event_'.$number.'_date'] = $isEnabled ? '1 Januari 2027, 10.00' : '';
            $events['landing_event_'.$number.'_location'] = $isEnabled ? 'Lokasi acara '.$number : '';
            $events['landing_event_'.$number.'_text'] = $isEnabled ? 'Deskripsi acara '.$number : '';
            $events['landing_event_'.$number.'_location_label'] = $locationIsEnabled ? 'Lihat lokasi' : '';
            $events['landing_event_'.$number.'_location_url'] = $locationIsEnabled ? 'https://maps.google.com/?q=acara'.$number : '';
        }

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'event',
                'landing_section_event' => '1',
                'landing_event_title' => 'Jadwal acara',
                ...$events,
            ])
            ->assertRedirect();

        $this->assertSame('0', (string) Setting::value('landing_event_2_enabled'));
        $this->assertSame('Acara 1', Setting::value('landing_event_1_title'));

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringContainsString('Acara 1', $content);
        $this->assertStringNotContainsString('Acara 2', $content);
        $this->assertStringNotContainsString('q=acara1', $content);
    }
}
