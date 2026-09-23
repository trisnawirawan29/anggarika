<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __invoke(): View
    {
        $defaults = [
            'landing_page_title' => 'Millar & Aliza · Wedding Invitation',
            'landing_hero_subtitle' => 'WERE GETTING MARRIED',
            'landing_hero_title' => 'Save Our Date',
            'landing_hero_date' => '25 December 2019',
            'landing_countdown_date' => '2026-12-31T00:00',
            'landing_couple_title' => 'Happy Couple',
            'landing_bride_name' => 'Aliza Elizabeth',
            'landing_bride_bio' => 'Hi, I am Aliza Elizabeth. Thank you for being part of our special day.',
            'landing_groom_name' => 'Millar Wiliam',
            'landing_groom_bio' => 'Hi, I am Millar Wiliam. We are delighted to celebrate this moment with you.',
            'landing_bride_name_font_size' => '32',
            'landing_bride_name_font_family' => 'inherit',
            'landing_groom_name_font_size' => '32',
            'landing_groom_name_font_family' => 'inherit',
            'landing_bride_facebook_url' => '#',
            'landing_bride_twitter_url' => '#',
            'landing_bride_instagram_url' => '#',
            'landing_bride_linkedin_url' => '#',
            'landing_groom_facebook_url' => '#',
            'landing_groom_twitter_url' => '#',
            'landing_groom_instagram_url' => '#',
            'landing_groom_linkedin_url' => '#',
            'landing_story_title' => 'Our love story',
            'landing_story_1_title' => 'First time we met',
            'landing_story_1_date' => 'Jan 12 2019',
            'landing_story_1_text' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend,',
            'landing_story_2_title' => 'Our First Date',
            'landing_story_2_date' => 'Feb 14 2019',
            'landing_story_2_text' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend,',
            'landing_story_3_title' => 'Our Marriage Proposal',
            'landing_story_3_date' => 'Apr 14 2019',
            'landing_story_3_text' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend,',
            'landing_story_4_title' => 'Our Engagement',
            'landing_story_4_date' => 'Jul 14 2019',
            'landing_story_4_text' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend,',
            'landing_cta_title' => 'Welcome to our big day',
            'landing_cta_text' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or less normal distribution of letters',
            'landing_cta_rsvp_label' => 'RSVP',
            'landing_cta_rsvp_url' => '#rsvp',
            'landing_cta_location_label' => 'Location',
            'landing_cta_location_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25211.21212385712!2d144.95275648773628!3d-37.82748510398018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2zTWVsYm91cm5lIFZJQyAzMDA0LCDgpoXgprjgp43gpp_gp43gprDgp4fgprLgpr_gpq_gprzgpr4!5e0!3m2!1sbn!2sbd!4v1503742051881',
            'landing_cta_gallery_title' => 'Welcome to our big day',
            'landing_cta_gallery_text' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or less normal distribution of letters',
            'landing_cta_gallery_rsvp_label' => 'RSVP',
            'landing_cta_gallery_rsvp_url' => '#rsvp',
            'landing_cta_gallery_location_label' => 'Location',
            'landing_cta_gallery_location_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25211.21212385712!2d144.95275648773628!3d-37.82748510398018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2zTWVsYm91cm5lIFZJQyAzMDA0LCDgpoXgprjgp43gpp_gp43gprDgp4fgprLgpr_gpq_gprzgpr4!5e0!3m2!1sbn!2sbd!4v1503742051881',
            'landing_event_title' => 'When & Where',
            'landing_people_title' => 'Groomsmen & Bridesmaid',
            'landing_gallery_title' => 'Our Gallery',
            'landing_rsvp_title' => 'Be Our RSVP',
            'landing_footer_title' => 'Millar & Aliza Forever',
            'landing_music_file' => '',
        ];
        $sectionDefaults = [
            'landing_section_hero' => true,
            'landing_section_couple' => true,
            'landing_section_countdown' => true,
            'landing_section_story' => true,
            'landing_story_1_enabled' => true,
            'landing_story_2_enabled' => true,
            'landing_story_3_enabled' => true,
            'landing_story_4_enabled' => true,
            'landing_bride_facebook_enabled' => true,
            'landing_bride_twitter_enabled' => true,
            'landing_bride_instagram_enabled' => true,
            'landing_bride_linkedin_enabled' => true,
            'landing_groom_facebook_enabled' => true,
            'landing_groom_twitter_enabled' => true,
            'landing_groom_instagram_enabled' => true,
            'landing_groom_linkedin_enabled' => true,
            'landing_section_cta' => true,
            'landing_cta_rsvp_enabled' => true,
            'landing_cta_location_enabled' => true,
            'landing_section_event' => true,
            'landing_section_people' => true,
            'landing_section_cta_gallery' => true,
            'landing_cta_gallery_rsvp_enabled' => true,
            'landing_cta_gallery_location_enabled' => true,
            'landing_section_gallery' => true,
            'landing_section_rsvp' => true,
            'landing_section_gta' => true,
            'landing_section_gift' => true,
            'landing_section_footer' => true,
            'landing_section_music' => true,
        ];

        $settings = Setting::query()->pluck('value', 'key');
        $landing = collect($defaults)->mapWithKeys(
            fn (string $default, string $key): array => [$key => $settings->get($key, $default)]
        );
        $sections = collect($sectionDefaults)->mapWithKeys(
            fn (bool $default, string $key): array => [$key => filter_var($settings->get($key, $default), FILTER_VALIDATE_BOOLEAN)]
        );
        $landing = $landing->merge($sections);

        $photoDefaults = [
            'landing_hero_background' => 'assets/images/slider/slide-4.jpg',
            'landing_bride_photo' => 'assets/images/story/1.jpg',
            'landing_groom_photo' => 'assets/images/story/2.jpg',
            'landing_story_photo_1' => 'assets/images/story/img-1.jpg',
            'landing_story_photo_2' => 'assets/images/story/img-2.jpg',
            'landing_story_photo_3' => 'assets/images/story/img-3.jpg',
            'landing_story_photo_4' => 'assets/images/story/img-4.jpg',
            'landing_event_photo_1' => 'assets/images/events/img-1.jpg',
            'landing_event_photo_2' => 'assets/images/events/img-2.jpg',
            'landing_event_photo_3' => 'assets/images/events/img-3.jpg',
            'landing_event_photo_4' => 'assets/images/events/img-4.jpg',
            'landing_gallery_photo_1' => 'assets/images/gallery/img-1.jpg',
            'landing_gallery_photo_2' => 'assets/images/gallery/img-2.jpg',
            'landing_gallery_photo_3' => 'assets/images/gallery/img-3.jpg',
            'landing_gallery_photo_4' => 'assets/images/gallery/img-4.jpg',
            'landing_gallery_photo_5' => 'assets/images/gallery/img-5.jpg',
            'landing_gallery_photo_6' => 'assets/images/gallery/img-6.jpg',
            'landing_countdown_background' => 'assets/images/counter/1.jpg',
            'landing_cta_background' => 'assets/images/cta/img-1.jpg',
            'landing_cta_gallery_background' => 'assets/images/cta/img-1.jpg',
            'landing_rsvp_background' => 'assets/images/rsvp/img-1.jpg',
            'landing_footer_background' => 'assets/images/footer-bg.jpg',
        ];
        $photos = collect($photoDefaults)->mapWithKeys(
            fn (string $default, string $key): array => [$key => str_starts_with((string) $settings->get($key, ''), 'landing/')
                ? asset('storage/'.$settings->get($key))
                : asset($settings->get($key, $default))]
        );
        $landing = $landing->merge($photos);
        $musicFile = (string) $settings->get('landing_music_file', '');
        $landing['landing_music_file'] = $musicFile === ''
            ? ''
            : (str_starts_with($musicFile, 'landing/') ? asset('storage/'.$musicFile) : asset($musicFile));

        return view('landing', compact('landing'));
    }
}
