<?php

namespace Tests\Feature;

use App\Models\LandingGalleryItem;
use App\Models\Role;
use App\Models\RsvpMessage;
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
        $order = ['hero', 'story', 'couple', 'countdown', 'video', 'cta', 'event', 'schedule', 'people', 'cta_gallery', 'penutup', 'gallery', 'rsvp', 'gta', 'gift', 'footer', 'music'];

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
        $order = ['hero', 'story', 'couple', 'countdown', 'video', 'cta', 'event', 'schedule', 'people', 'cta_gallery', 'penutup', 'gallery', 'rsvp', 'gta', 'gift', 'footer', 'music'];
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

    public function test_admin_can_configure_youtube_video_section(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'video',
                'landing_section_video' => '1',
                'landing_video_title' => 'Video Pernikahan',
                'landing_video_source' => 'youtube',
                'landing_video_youtube_url' => 'https://youtu.be/dQw4w9WgXcQ',
            ])
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringContainsString('Video Pernikahan', $content);
        $this->assertStringContainsString('https://www.youtube.com/embed/dQw4w9WgXcQ', $content);
    }

    public function test_admin_can_upload_video_file(): void
    {
        Storage::fake('public');
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'video',
                'landing_section_video' => '1',
                'landing_video_title' => 'Video Upload',
                'landing_video_source' => 'upload',
                'landing_video_youtube_url' => '',
                'landing_video_file' => UploadedFile::fake()->create('wedding.mp4', 100, 'video/mp4'),
            ])
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();

        Storage::disk('public')->assertExists((string) Setting::value('landing_video_file'));
    }

    public function test_admin_can_add_gallery_photos_with_categories(): void
    {
        Storage::fake('public');
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->post(route('admin.landing-settings.gallery.store'), [
                'photo' => UploadedFile::fake()->create('engagement.jpg', 100, 'image/jpeg'),
            ])
            ->assertRedirect();

        $galleryItem = LandingGalleryItem::query()->firstOrFail();
        $this->assertSame('Galeri', $galleryItem->category);
        Storage::disk('public')->assertExists($galleryItem->image_path);

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringNotContainsString('gallery-filters', $content);
        $this->assertStringContainsString('alt="Foto galeri"', $content);
    }

    public function test_admin_can_configure_gallery_columns(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'gallery',
                'landing_section_gallery' => '1',
                'landing_gallery_title' => 'Galeri Pernikahan',
                'landing_gallery_columns' => '3',
            ])
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();

        $this->assertSame('3', Setting::value('landing_gallery_columns'));
        $this->get(route('landing'))
            ->assertSee('--gallery-columns: 3;', false);
    }

    public function test_admin_can_configure_cta_background_transparency(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'cta',
                'landing_section_cta' => '1',
                'landing_cta_title' => 'Hari bahagia kami',
                'landing_cta_title_font_size' => '42',
                'landing_cta_title_font_family' => 'inherit',
                'landing_cta_text' => 'Sampai jumpa di acara kami.',
                'landing_cta_text_font_size' => '16',
                'landing_cta_text_font_family' => 'inherit',
                'landing_cta_background_transparency' => '65',
                'landing_cta_rsvp_enabled' => '0',
                'landing_cta_location_enabled' => '0',
                'landing_cta_rsvp_label' => '',
                'landing_cta_rsvp_url' => '',
                'landing_cta_location_label' => '',
                'landing_cta_location_url' => '',
            ])
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();

        $this->assertSame('65', Setting::value('landing_cta_background_transparency'));
        $this->get(route('landing'))
            ->assertOk()
            ->assertSee('--cta-overlay-opacity: 0.35;', false);
    }

    public function test_admin_can_configure_penutup_section(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'penutup',
                'landing_section_penutup' => '1',
                'landing_penutup_title' => 'Sampai Jumpa',
                'landing_penutup_text' => 'Terima kasih atas kehadiran Anda.',
                'landing_penutup_button_label' => 'Kirim ucapan',
                'landing_penutup_button_url' => '#rsvp',
                'landing_penutup_background_transparency' => '20',
            ])
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();

        $this->assertSame('Sampai Jumpa', Setting::value('landing_penutup_title'));
        $this->get(route('landing'))
            ->assertSee('Sampai Jumpa')
            ->assertSee('Terima kasih atas kehadiran Anda.')
            ->assertSee('data-landing-section="penutup"', false);
    }

    public function test_admin_can_configure_gallery_cta_and_penutup_background_transparency(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'cta_gallery',
                'landing_section_cta_gallery' => '1',
                'landing_cta_gallery_title' => 'CTA galeri',
                'landing_cta_gallery_text' => 'Lihat momen kami.',
                'landing_cta_gallery_background_transparency' => '45',
                'landing_cta_gallery_rsvp_enabled' => '0',
                'landing_cta_gallery_location_enabled' => '0',
                'landing_cta_gallery_rsvp_label' => '',
                'landing_cta_gallery_rsvp_url' => '',
                'landing_cta_gallery_location_label' => '',
                'landing_cta_gallery_location_url' => '',
            ])
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'penutup',
                'landing_section_penutup' => '1',
                'landing_penutup_title' => 'Sampai jumpa',
                'landing_penutup_text' => 'Terima kasih.',
                'landing_penutup_button_label' => 'Kirim ucapan',
                'landing_penutup_button_url' => '#rsvp',
                'landing_penutup_background_transparency' => '70',
            ])
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();

        $this->assertSame('45', Setting::value('landing_cta_gallery_background_transparency'));
        $this->assertSame('70', Setting::value('landing_penutup_background_transparency'));

        $this->get(route('landing'))
            ->assertOk()
            ->assertSee('--cta-gallery-overlay-opacity: 0.55;', false)
            ->assertSee('--penutup-overlay-opacity: 0.3;', false);
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

    public function test_admin_can_configure_gift_registration_account_details(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'gift',
                'landing_section_gift' => '1',
                'landing_gift_title' => 'Hadiah Pernikahan',
                'landing_gift_description' => 'Terima kasih atas perhatian dan doa Anda.',
                'landing_gift_bank_name' => 'Bank Mandiri',
                'landing_gift_account_number' => '9876543210',
                'landing_gift_account_holder' => 'Angga & Rika',
            ])
            ->assertRedirect();

        $this->assertSame('Bank Mandiri', Setting::value('landing_gift_bank_name'));
        $this->assertSame('9876543210', Setting::value('landing_gift_account_number'));
        $this->assertSame('Hadiah Pernikahan', Setting::value('landing_gift_title'));

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringContainsString('Terima kasih atas perhatian dan doa Anda.', $content);
        $this->assertStringContainsString('Hadiah Pernikahan', $content);
        $this->assertStringContainsString('9876543210', $content);
        $this->assertStringContainsString('Angga &amp; Rika', $content);
    }

    public function test_admin_can_configure_multiple_gift_registration_accounts(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'gift',
                'landing_section_gift' => '1',
                'landing_gift_title' => 'Hadiah Pernikahan',
                'landing_gift_description' => 'Terima kasih atas perhatian dan doa Anda.',
                'landing_gift_accounts' => [
                    ['bank_name' => 'Bank Mandiri', 'account_number' => '9876543210', 'account_holder' => 'Angga & Rika'],
                    ['bank_name' => 'Bank BCA', 'account_number' => '1234567890', 'account_holder' => 'Rika & Angga'],
                ],
            ])
            ->assertRedirect();

        $this->assertSame([
            ['bank_name' => 'Bank Mandiri', 'account_number' => '9876543210', 'account_holder' => 'Angga & Rika'],
            ['bank_name' => 'Bank BCA', 'account_number' => '1234567890', 'account_holder' => 'Rika & Angga'],
        ], json_decode((string) Setting::value('landing_gift_accounts'), true));

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringContainsString('9876543210', $content);
        $this->assertStringContainsString('1234567890', $content);
        $this->assertSame(2, substr_count($content, 'gift-card"'));
    }

    public function test_guest_can_submit_rsvp_message_and_latest_messages_are_displayed_first(): void
    {
        RsvpMessage::query()->create(['name' => 'Pesan Lama', 'message' => 'Ucapan lama.']);

        $this->withSession(['rsvp_captcha_answer' => 7])
            ->post(route('rsvp.messages.store'), [
                'name' => 'Pesan Baru',
                'message' => 'Semoga bahagia selalu.',
                'captcha_answer' => 7,
            ])->assertRedirect(route('landing').'#rsvp');

        $this->assertDatabaseHas('rsvp_messages', [
            'name' => 'Pesan Baru',
            'message' => 'Semoga bahagia selalu.',
        ]);

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringContainsString('Sampaikan doa dan ucapan terbaik Anda', $content);
        $this->assertStringContainsString('Pesan Baru', $content);
        $this->assertStringContainsString('Pesan Lama', $content);
        $this->assertLessThan(
            strpos($content, 'Pesan Lama'),
            strpos($content, 'Pesan Baru'),
        );
    }

    public function test_guest_cannot_submit_rsvp_message_with_an_incorrect_captcha(): void
    {
        $this->withSession(['rsvp_captcha_answer' => 7])
            ->post(route('rsvp.messages.store'), [
                'name' => 'Tamu Baru',
                'message' => 'Semoga bahagia selalu.',
                'captcha_answer' => 8,
            ])
            ->assertSessionHasErrors(['captcha_answer' => 'Jawaban CAPTCHA salah.']);

        $this->assertDatabaseMissing('rsvp_messages', [
            'name' => 'Tamu Baru',
        ]);
    }

    public function test_admin_can_delete_an_rsvp_message(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);
        $message = RsvpMessage::query()->create(['name' => 'Tamu', 'message' => 'Ucapan untuk dihapus.']);

        $this->actingAs($admin)
            ->delete(route('admin.rsvp.messages.destroy', $message))
            ->assertRedirect();

        $this->assertDatabaseMissing('rsvp_messages', ['id' => $message->id]);
    }

    public function test_admin_can_search_rsvp_messages_by_name_or_content(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);
        RsvpMessage::query()->create(['name' => 'Budi', 'message' => 'Semoga langgeng.']);
        RsvpMessage::query()->create(['name' => 'Sari', 'message' => 'Selamat menempuh hidup baru.']);

        $content = $this->actingAs($admin)
            ->get(route('admin.landing-settings', ['rsvp_search' => 'Budi']))
            ->assertOk()
            ->getContent();

        $this->assertStringContainsString('Semoga langgeng.', $content);
        $this->assertStringNotContainsString('Selamat menempuh hidup baru.', $content);
    }

    public function test_admin_can_configure_footer_description_typography(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'footer',
                'landing_section_footer' => '1',
                'landing_footer_title' => 'Angga & Rika',
                'landing_footer_description' => 'Terima kasih telah hadir di hari bahagia kami.',
                'landing_footer_description_font_size' => '18',
                'landing_footer_description_font_family' => 'Georgia, serif',
            ])
            ->assertRedirect();

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringContainsString('Terima kasih telah hadir di hari bahagia kami.', $content);
        $this->assertStringContainsString('font-size: 18px; font-family: Georgia, serif;', $content);
    }

    public function test_admin_can_configure_the_schedule_card_count(): void
    {
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $admin = User::factory()->create(['role' => 'admin', 'role_id' => $adminRole->id]);

        $response = $this->actingAs($admin)
            ->put(route('admin.landing-settings.update'), [
                'save_section' => 'schedule',
                'landing_section_schedule' => '1',
                'landing_schedule_title' => 'Rangkaian Acara',
                'landing_schedule_count' => '2',
                'landing_schedule_1_name' => 'Akad Nikah',
                'landing_schedule_1_date' => '25 Desember 2026',
                'landing_schedule_1_time' => '08.00 WITA',
                'landing_schedule_1_location' => 'Gedung A',
                'landing_schedule_1_location_enabled' => '1',
                'landing_schedule_1_location_url' => 'https://maps.google.com/?q=GedungA',
                'landing_schedule_2_name' => 'Resepsi',
                'landing_schedule_2_date' => '25 Desember 2026',
                'landing_schedule_2_time' => '11.00 WITA',
                'landing_schedule_2_location' => 'Gedung B',
                'landing_schedule_2_location_enabled' => '0',
                'landing_schedule_2_location_url' => '',
                'landing_schedule_3_name' => '',
                'landing_schedule_3_date' => '',
                'landing_schedule_3_time' => '',
                'landing_schedule_3_location' => '',
                'landing_schedule_3_location_enabled' => '0',
                'landing_schedule_3_location_url' => '',
                'landing_schedule_4_name' => '',
                'landing_schedule_4_date' => '',
                'landing_schedule_4_time' => '',
                'landing_schedule_4_location' => '',
                'landing_schedule_4_location_enabled' => '0',
                'landing_schedule_4_location_url' => '',
                'landing_schedule_5_name' => '',
                'landing_schedule_5_date' => '',
                'landing_schedule_5_time' => '',
                'landing_schedule_5_location' => '',
                'landing_schedule_5_location_enabled' => '0',
                'landing_schedule_5_location_url' => '',
                'landing_schedule_6_name' => '',
                'landing_schedule_6_date' => '',
                'landing_schedule_6_time' => '',
                'landing_schedule_6_location' => '',
                'landing_schedule_6_location_enabled' => '0',
                'landing_schedule_6_location_url' => '',
            ])
            ->assertRedirect();

        $this->assertSame('2', (string) Setting::value('landing_schedule_count'));
        $this->assertSame('Rangkaian Acara', Setting::value('landing_schedule_title'));

        $content = $this->get(route('landing'))->assertOk()->getContent();

        $this->assertStringContainsString('Akad Nikah', $content);
        $this->assertStringContainsString('Resepsi', $content);
        $this->assertStringNotContainsString('Acara 3', $content);
    }
}
