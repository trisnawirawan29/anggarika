<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Support\AuditLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LandingSettingsController extends Controller
{
    /** @var list<string> */
    private const LANDING_PHOTO_KEYS = [
        'landing_hero_background',
        'landing_bride_photo', 'landing_groom_photo',
        'landing_story_photo_1', 'landing_story_photo_2', 'landing_story_photo_3', 'landing_story_photo_4',
        'landing_event_photo_1', 'landing_event_photo_2', 'landing_event_photo_3', 'landing_event_photo_4',
        'landing_gallery_photo_1', 'landing_gallery_photo_2', 'landing_gallery_photo_3',
        'landing_gallery_photo_4', 'landing_gallery_photo_5', 'landing_gallery_photo_6',
        'landing_countdown_background', 'landing_cta_background', 'landing_cta_gallery_background', 'landing_rsvp_background', 'landing_footer_background',
    ];

    public function edit(): View
    {
        $settings = Setting::query()->pluck('value', 'key');

        return view('admin.landing-settings', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'landing_page_title' => ['required', 'string', 'max:160'],
            'landing_hero_subtitle' => ['required', 'string', 'max:120'],
            'landing_hero_title' => ['required', 'string', 'max:120'],
            'landing_hero_date' => ['required', 'string', 'max:120'],
            'landing_countdown_date' => ['required', 'date_format:Y-m-d\\TH:i'],
            'landing_couple_title' => ['required', 'string', 'max:120'],
            'landing_bride_name' => ['required', 'string', 'max:120'],
            'landing_bride_bio' => ['required', 'string', 'max:500'],
            'landing_groom_name' => ['required', 'string', 'max:120'],
            'landing_groom_bio' => ['required', 'string', 'max:500'],
            'landing_story_title' => ['required', 'string', 'max:120'],
            'landing_cta_title' => ['required', 'string', 'max:120'],
            'landing_cta_text' => ['required', 'string', 'max:1000'],
            'landing_cta_rsvp_label' => ['required', 'string', 'max:80'],
            'landing_cta_rsvp_url' => ['required', 'string', 'max:2048'],
            'landing_cta_location_label' => ['required', 'string', 'max:80'],
            'landing_cta_location_url' => ['required', 'url', 'max:2048'],
            'landing_cta_gallery_title' => ['required', 'string', 'max:120'],
            'landing_cta_gallery_text' => ['required', 'string', 'max:1000'],
            'landing_cta_gallery_rsvp_label' => ['required', 'string', 'max:80'],
            'landing_cta_gallery_rsvp_url' => ['required', 'string', 'max:2048'],
            'landing_cta_gallery_location_label' => ['required', 'string', 'max:80'],
            'landing_cta_gallery_location_url' => ['required', 'url', 'max:2048'],
            'landing_event_title' => ['required', 'string', 'max:120'],
            'landing_people_title' => ['required', 'string', 'max:120'],
            'landing_gallery_title' => ['required', 'string', 'max:120'],
            'landing_rsvp_title' => ['required', 'string', 'max:120'],
            'landing_footer_title' => ['required', 'string', 'max:120'],
            'landing_section_hero' => ['required', 'boolean'],
            'landing_section_couple' => ['required', 'boolean'],
            'landing_section_countdown' => ['required', 'boolean'],
            'landing_section_story' => ['required', 'boolean'],
            'landing_story_1_enabled' => ['required', 'boolean'],
            'landing_story_2_enabled' => ['required', 'boolean'],
            'landing_story_3_enabled' => ['required', 'boolean'],
            'landing_story_4_enabled' => ['required', 'boolean'],
            'landing_section_cta' => ['required', 'boolean'],
            'landing_cta_rsvp_enabled' => ['required', 'boolean'],
            'landing_cta_location_enabled' => ['required', 'boolean'],
            'landing_section_event' => ['required', 'boolean'],
            'landing_section_people' => ['required', 'boolean'],
            'landing_section_cta_gallery' => ['required', 'boolean'],
            'landing_cta_gallery_rsvp_enabled' => ['required', 'boolean'],
            'landing_cta_gallery_location_enabled' => ['required', 'boolean'],
            'landing_section_gallery' => ['required', 'boolean'],
            'landing_section_rsvp' => ['required', 'boolean'],
            'landing_section_gta' => ['required', 'boolean'],
            'landing_section_gift' => ['required', 'boolean'],
            'landing_section_footer' => ['required', 'boolean'],
            'landing_section_music' => ['required', 'boolean'],
            ...array_fill_keys(self::LANDING_PHOTO_KEYS, ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']),
        ];

        $conditionalFields = [
            'hero' => [
                'landing_page_title' => ['string', 160],
                'landing_hero_subtitle' => ['string', 120],
                'landing_hero_title' => ['string', 120],
                'landing_hero_date' => ['string', 120],
            ],
            'countdown' => [
                'landing_countdown_date' => ['date_format:Y-m-d\\TH:i', 16],
            ],
            'couple' => [
                'landing_couple_title' => ['string', 120],
                'landing_bride_name' => ['string', 120],
                'landing_bride_bio' => ['string', 500],
                'landing_groom_name' => ['string', 120],
                'landing_groom_bio' => ['string', 500],
            ],
            'story' => [
                'landing_story_title' => ['string', 120],
            ],
            'cta' => [
                'landing_cta_title' => ['string', 120],
                'landing_cta_text' => ['string', 1000],
                'landing_cta_rsvp_label' => ['string', 80],
                'landing_cta_rsvp_url' => ['string', 2048],
                'landing_cta_location_label' => ['string', 80],
                'landing_cta_location_url' => ['url', 2048],
            ],
            'event' => [
                'landing_event_title' => ['string', 120],
            ],
            'people' => [
                'landing_people_title' => ['string', 120],
            ],
            'gallery' => [
                'landing_gallery_title' => ['string', 120],
            ],
            'rsvp' => [
                'landing_rsvp_title' => ['string', 120],
            ],
            'footer' => [
                'landing_footer_title' => ['string', 120],
            ],
            'cta_gallery' => [
                'landing_cta_gallery_title' => ['string', 120],
                'landing_cta_gallery_text' => ['string', 1000],
                'landing_cta_gallery_rsvp_label' => ['string', 80],
                'landing_cta_gallery_rsvp_url' => ['string', 2048],
                'landing_cta_gallery_location_label' => ['string', 80],
                'landing_cta_gallery_location_url' => ['url', 2048],
            ],
        ];

        foreach ($conditionalFields as $section => $fields) {
            foreach ($fields as $field => [$type, $maxLength]) {
                $rules[$field] = [
                    Rule::requiredIf($request->boolean('landing_section_'.$section)),
                    'nullable',
                    $type,
                    'max:'.$maxLength,
                ];
            }
        }

        $buttonFields = [
            ['landing_cta', 'landing_cta_rsvp_enabled', 'landing_cta_rsvp_label', 'string', 80],
            ['landing_cta', 'landing_cta_rsvp_enabled', 'landing_cta_rsvp_url', 'string', 2048],
            ['landing_cta', 'landing_cta_location_enabled', 'landing_cta_location_label', 'string', 80],
            ['landing_cta', 'landing_cta_location_enabled', 'landing_cta_location_url', 'url', 2048],
            ['landing_cta_gallery', 'landing_cta_gallery_rsvp_enabled', 'landing_cta_gallery_rsvp_label', 'string', 80],
            ['landing_cta_gallery', 'landing_cta_gallery_rsvp_enabled', 'landing_cta_gallery_rsvp_url', 'string', 2048],
            ['landing_cta_gallery', 'landing_cta_gallery_location_enabled', 'landing_cta_gallery_location_label', 'string', 80],
            ['landing_cta_gallery', 'landing_cta_gallery_location_enabled', 'landing_cta_gallery_location_url', 'url', 2048],
        ];

        foreach ($buttonFields as [$section, $button, $field, $type, $maxLength]) {
            $rules[$field] = [
                Rule::requiredIf($request->boolean('landing_section_'.$section) && $request->boolean($button)),
                'nullable',
                $type,
                'max:'.$maxLength,
            ];
        }

        foreach (range(1, 4) as $number) {
            $storyIsEnabled = $request->boolean('landing_section_story')
                && $request->boolean('landing_story_'.$number.'_enabled');
            $rules['landing_story_'.$number.'_title'] = [$storyIsEnabled ? 'required' : 'nullable', 'string', 'max:120'];
            $rules['landing_story_'.$number.'_date'] = [$storyIsEnabled ? 'required' : 'nullable', 'string', 'max:120'];
            $rules['landing_story_'.$number.'_text'] = [$storyIsEnabled ? 'required' : 'nullable', 'string', 'max:1000'];
        }

        foreach (['bride', 'groom'] as $person) {
            foreach (['facebook', 'twitter', 'instagram', 'linkedin'] as $network) {
                $enabledKey = 'landing_'.$person.'_'.$network.'_enabled';
                $urlKey = 'landing_'.$person.'_'.$network.'_url';
                $rules[$enabledKey] = ['required', 'boolean'];
                $rules[$urlKey] = [
                    Rule::requiredIf($request->boolean('landing_section_couple') && $request->boolean($enabledKey)),
                    'nullable',
                    'string',
                    'max:2048',
                ];
            }
        }

        $data = $request->validate($rules);

        foreach (self::LANDING_PHOTO_KEYS as $key) {
            if (! $request->hasFile($key)) {
                unset($data[$key]);

                continue;
            }

            $oldPhoto = Setting::value($key);
            $newPhoto = $request->file($key)->store('landing', 'public');
            if (is_string($oldPhoto) && str_starts_with($oldPhoto, 'landing/')) {
                Storage::disk('public')->delete($oldPhoto);
            }
            $data[$key] = $newPhoto;
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        AuditLogger::record('landing_settings.updated', 'Pengaturan landing page diperbarui.', null, [], ['keys' => array_keys($data)]);

        return back()->with('success', 'Pengaturan landing page berhasil disimpan.');
    }

    public function uploadPhoto(Request $request): JsonResponse
    {
        $data = $request->validate([
            'photo_key' => ['required', Rule::in(self::LANDING_PHOTO_KEYS)],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $oldPhoto = Setting::value($data['photo_key']);
        $newPhoto = $request->file('photo')->store('landing', 'public');
        if (is_string($oldPhoto) && str_starts_with($oldPhoto, 'landing/')) {
            Storage::disk('public')->delete($oldPhoto);
        }

        Setting::updateOrCreate(['key' => $data['photo_key']], ['value' => $newPhoto]);
        AuditLogger::record('landing_photo.updated', 'Foto landing page diperbarui.', null, [], ['key' => $data['photo_key']]);

        return response()->json(['url' => asset('storage/'.$newPhoto)]);
    }
}
