<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Support\AuditLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LandingSettingsController extends Controller
{
    /** @var list<string> */
    private const LANDING_SECTION_ORDER = [
        'hero', 'couple', 'countdown', 'story', 'cta', 'event', 'schedule', 'people', 'cta_gallery',
        'gallery', 'rsvp', 'gta', 'gift', 'footer', 'music',
    ];

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

    private const LANDING_AUDIO_KEYS = ['landing_music_file'];

    public function edit(): View
    {
        $settings = Setting::query()->pluck('value', 'key');
        $sectionOrder = $this->sectionOrder($settings->get('landing_section_order'));

        return view('admin.landing-settings', compact('settings', 'sectionOrder'));
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
            'landing_bride_name_font_size' => ['required', 'integer', 'between:16,96'],
            'landing_bride_name_font_family' => ['required', Rule::in(['inherit', 'Arial, sans-serif', 'Georgia, serif', 'Trebuchet MS, sans-serif', 'Courier New, monospace'])],
            'landing_groom_name_font_size' => ['required', 'integer', 'between:16,96'],
            'landing_groom_name_font_family' => ['required', Rule::in(['inherit', 'Arial, sans-serif', 'Georgia, serif', 'Trebuchet MS, sans-serif', 'Courier New, monospace'])],
            'landing_story_title' => ['required', 'string', 'max:120'],
            'landing_cta_title' => ['required', 'string', 'max:120'],
            'landing_cta_title_font_size' => ['required', 'integer', 'between:16,96'],
            'landing_cta_title_font_family' => ['required', Rule::in(['inherit', 'Arial, sans-serif', 'Georgia, serif', 'Trebuchet MS, sans-serif', 'Courier New, monospace'])],
            'landing_cta_text' => ['required', 'string', 'max:1000'],
            'landing_cta_text_font_size' => ['required', 'integer', 'between:12,48'],
            'landing_cta_text_font_family' => ['required', Rule::in(['inherit', 'Arial, sans-serif', 'Georgia, serif', 'Trebuchet MS, sans-serif', 'Courier New, monospace'])],
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
            'landing_schedule_title' => ['required', 'string', 'max:120'],
            'landing_schedule_count' => ['required', 'integer', 'between:1,6'],
            ...array_fill_keys(array_map(fn (int $number): string => 'landing_event_'.$number.'_enabled', range(1, 4)), ['required', 'boolean']),
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
            'landing_section_schedule' => ['required', 'boolean'],
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
            'landing_section_order' => ['required', 'json'],
            ...array_fill_keys(self::LANDING_PHOTO_KEYS, ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']),
            'landing_music_file' => ['nullable', 'file', 'mimes:mp3', 'max:10240'],
        ];

        $conditionalFields = [
            'hero' => [
                'landing_page_title' => ['type' => 'string', 'max' => 160],
                'landing_hero_subtitle' => ['type' => 'string', 'max' => 120],
                'landing_hero_title' => ['type' => 'string', 'max' => 120],
                'landing_hero_date' => ['type' => 'string', 'max' => 120],
            ],
            'countdown' => [
                'landing_countdown_date' => ['type' => 'date_format:Y-m-d\\TH:i', 'max' => 16],
            ],
            'couple' => [
                'landing_couple_title' => ['type' => 'string', 'max' => 120],
                'landing_bride_name' => ['type' => 'string', 'max' => 120],
                'landing_bride_bio' => ['type' => 'string', 'max' => 500],
                'landing_groom_name' => ['type' => 'string', 'max' => 120],
                'landing_groom_bio' => ['type' => 'string', 'max' => 500],
            ],
            'story' => [
                'landing_story_title' => ['type' => 'string', 'max' => 120],
            ],
            'cta' => [
                'landing_cta_title' => ['type' => 'string', 'max' => 120],
                'landing_cta_text' => ['type' => 'string', 'max' => 1000],
                'landing_cta_rsvp_label' => ['type' => 'string', 'max' => 80],
                'landing_cta_rsvp_url' => ['type' => 'string', 'max' => 2048],
                'landing_cta_location_label' => ['type' => 'string', 'max' => 80],
                'landing_cta_location_url' => ['type' => 'url', 'max' => 2048],
            ],
            'event' => [
                'landing_event_title' => ['type' => 'string', 'max' => 120],
            ],
            'schedule' => [
                'landing_schedule_title' => ['type' => 'string', 'max' => 120],
            ],
            'people' => [
                'landing_people_title' => ['type' => 'string', 'max' => 120],
            ],
            'gallery' => [
                'landing_gallery_title' => ['type' => 'string', 'max' => 120],
            ],
            'rsvp' => [
                'landing_rsvp_title' => ['type' => 'string', 'max' => 120],
            ],
            'footer' => [
                'landing_footer_title' => ['type' => 'string', 'max' => 120],
            ],
            'cta_gallery' => [
                'landing_cta_gallery_title' => ['type' => 'string', 'max' => 120],
                'landing_cta_gallery_text' => ['type' => 'string', 'max' => 1000],
                'landing_cta_gallery_rsvp_label' => ['type' => 'string', 'max' => 80],
                'landing_cta_gallery_rsvp_url' => ['type' => 'string', 'max' => 2048],
                'landing_cta_gallery_location_label' => ['type' => 'string', 'max' => 80],
                'landing_cta_gallery_location_url' => ['type' => 'url', 'max' => 2048],
            ],
        ];

        foreach ($conditionalFields as $section => $fields) {
            foreach ($fields as $field => $fieldRules) {
                $type = $fieldRules['type'];
                $maxLength = $fieldRules['max'];
                $rules[$field] = [
                    Rule::requiredIf($request->boolean('landing_section_'.$section)),
                    'nullable',
                    $type,
                    'max:'.$maxLength,
                ];
            }
        }

        foreach (['bride', 'groom'] as $person) {
            $rules['landing_'.$person.'_name_font_size'] = [
                Rule::requiredIf($request->boolean('landing_section_couple')),
                'nullable',
                'integer',
                'between:16,96',
            ];
            $rules['landing_'.$person.'_name_font_family'] = [
                Rule::requiredIf($request->boolean('landing_section_couple')),
                'nullable',
                Rule::in(['inherit', 'Arial, sans-serif', 'Georgia, serif', 'Trebuchet MS, sans-serif', 'Courier New, monospace']),
            ];
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

        for ($number = 1; $number <= 6; $number++) {
            $scheduleIsEnabled = $request->boolean('landing_section_schedule')
                && $number <= $request->integer('landing_schedule_count');

            foreach (['name' => 120, 'date' => 120, 'time' => 80, 'location' => 255] as $field => $maxLength) {
                $rules['landing_schedule_'.$number.'_'.$field] = [
                    $scheduleIsEnabled ? 'required' : 'nullable',
                    'nullable',
                    'string',
                    'max:'.$maxLength,
                ];
            }
        }

        foreach (range(1, 4) as $number) {
            $eventIsEnabled = $request->boolean('landing_section_event')
                && $request->boolean('landing_event_'.$number.'_enabled');
            $locationButtonIsEnabled = $eventIsEnabled
                && $request->boolean('landing_event_'.$number.'_location_enabled');

            $rules['landing_event_'.$number.'_location_enabled'] = ['required', 'boolean'];

            foreach ([
                'title' => ['string', 120],
                'date' => ['string', 120],
                'location' => ['string', 255],
                'text' => ['string', 1000],
                'location_label' => ['string', 80],
                'location_url' => ['string', 2048],
            ] as $field => [$type, $maxLength]) {
                $fieldIsRequired = in_array($field, ['location_label', 'location_url'], true)
                    ? $locationButtonIsEnabled
                    : $eventIsEnabled;

                $rules['landing_event_'.$number.'_'.$field] = [
                    $fieldIsRequired ? 'required' : 'nullable',
                    'nullable',
                    $type,
                    'max:'.$maxLength,
                ];
            }
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
                $usernameKey = 'landing_'.$person.'_'.$network.'_username';
                $rules[$usernameKey] = [
                    Rule::requiredIf($request->boolean('landing_section_couple') && $request->boolean($enabledKey)),
                    'nullable',
                    'string',
                    'max:80',
                ];
            }
        }

        $sectionFields = [
            'hero' => ['landing_section_hero', 'landing_page_title', 'landing_hero_subtitle', 'landing_hero_title', 'landing_hero_date', 'landing_hero_background'],
            'couple' => [
                'landing_section_couple', 'landing_couple_title', 'landing_bride_name', 'landing_bride_bio', 'landing_groom_name', 'landing_groom_bio',
                'landing_bride_photo', 'landing_groom_photo', 'landing_bride_name_font_size', 'landing_bride_name_font_family', 'landing_groom_name_font_size', 'landing_groom_name_font_family',
                ...array_map(fn (string $network): string => 'landing_bride_'.$network.'_enabled', ['facebook', 'twitter', 'instagram', 'linkedin']),
                ...array_map(fn (string $network): string => 'landing_bride_'.$network.'_url', ['facebook', 'twitter', 'instagram', 'linkedin']),
                ...array_map(fn (string $network): string => 'landing_bride_'.$network.'_username', ['facebook', 'twitter', 'instagram', 'linkedin']),
                ...array_map(fn (string $network): string => 'landing_groom_'.$network.'_enabled', ['facebook', 'twitter', 'instagram', 'linkedin']),
                ...array_map(fn (string $network): string => 'landing_groom_'.$network.'_url', ['facebook', 'twitter', 'instagram', 'linkedin']),
                ...array_map(fn (string $network): string => 'landing_groom_'.$network.'_username', ['facebook', 'twitter', 'instagram', 'linkedin']),
            ],
            'countdown' => ['landing_section_countdown', 'landing_countdown_date', 'landing_countdown_background'],
            'cta' => ['landing_section_cta', 'landing_cta_title', 'landing_cta_title_font_size', 'landing_cta_title_font_family', 'landing_cta_text', 'landing_cta_text_font_size', 'landing_cta_text_font_family', 'landing_cta_rsvp_label', 'landing_cta_rsvp_url', 'landing_cta_location_label', 'landing_cta_location_url', 'landing_cta_rsvp_enabled', 'landing_cta_location_enabled', 'landing_cta_background'],
            'rsvp' => ['landing_section_rsvp', 'landing_rsvp_title', 'landing_rsvp_background'],
            'story' => ['landing_section_story', 'landing_story_title', ...array_merge(
                ...array_map(fn (int $number): array => [
                    'landing_story_'.$number.'_enabled',
                    'landing_story_'.$number.'_title',
                    'landing_story_'.$number.'_date',
                    'landing_story_'.$number.'_text',
                    'landing_story_photo_'.$number,
                ], range(1, 4)),
            )],
            'event' => ['landing_section_event', 'landing_event_title', ...array_merge(
                ...array_map(fn (int $number): array => [
                    'landing_event_'.$number.'_enabled',
                    'landing_event_'.$number.'_title',
                    'landing_event_'.$number.'_date',
                    'landing_event_'.$number.'_location',
                    'landing_event_'.$number.'_text',
                    'landing_event_'.$number.'_location_enabled',
                    'landing_event_'.$number.'_location_label',
                    'landing_event_'.$number.'_location_url',
                    'landing_event_photo_'.$number,
                ], range(1, 4)),
            )],
            'schedule' => ['landing_section_schedule', 'landing_schedule_title', 'landing_schedule_count', ...array_merge(
                ...array_map(fn (int $number): array => [
                    'landing_schedule_'.$number.'_name',
                    'landing_schedule_'.$number.'_date',
                    'landing_schedule_'.$number.'_time',
                    'landing_schedule_'.$number.'_location',
                ], range(1, 6)),
            )],
            'people' => ['landing_section_people', 'landing_people_title'],
            'cta_gallery' => ['landing_section_cta_gallery', 'landing_cta_gallery_title', 'landing_cta_gallery_text', 'landing_cta_gallery_rsvp_label', 'landing_cta_gallery_rsvp_url', 'landing_cta_gallery_location_label', 'landing_cta_gallery_location_url', 'landing_cta_gallery_rsvp_enabled', 'landing_cta_gallery_location_enabled', 'landing_cta_gallery_background'],
            'gallery' => ['landing_section_gallery', 'landing_gallery_title', ...array_map(fn (int $number): string => 'landing_gallery_photo_'.$number, range(1, 6))],
            'gta' => ['landing_section_gta'],
            'gift' => ['landing_section_gift'],
            'music' => ['landing_section_music', 'landing_music_file'],
            'footer' => ['landing_section_footer', 'landing_footer_title', 'landing_footer_background'],
            'order' => ['landing_section_order'],
        ];

        $section = $request->validate([
            'save_section' => ['required', Rule::in(array_keys($sectionFields))],
        ])['save_section'];
        $data = $request->validate(array_intersect_key($rules, array_flip($sectionFields[$section])));

        if ($section === 'order') {
            $order = json_decode($data['landing_section_order'], true);
            if (! $this->isValidSectionOrder($order)) {
                throw ValidationException::withMessages([
                    'landing_section_order' => 'Urutan section tidak valid.',
                ]);
            }
        }

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

        foreach (self::LANDING_AUDIO_KEYS as $key) {
            if (! $request->hasFile($key)) {
                unset($data[$key]);

                continue;
            }

            $oldAudio = Setting::value($key);
            $newAudio = $request->file($key)->store('landing', 'public');
            if (is_string($oldAudio) && str_starts_with($oldAudio, 'landing/')) {
                Storage::disk('public')->delete($oldAudio);
            }
            $data[$key] = $newAudio;
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        AuditLogger::record('landing_settings.updated', 'Pengaturan landing page diperbarui.', null, [], ['keys' => array_keys($data)]);

        return back()->with('success', 'Pengaturan landing page berhasil disimpan.');
    }

    /** @return list<string> */
    private function sectionOrder(?string $value): array
    {
        $order = json_decode($value ?? '', true);

        if (! $this->isValidSectionOrder($order)) {
            return self::LANDING_SECTION_ORDER;
        }

        return $order;
    }

    private function isValidSectionOrder(mixed $order): bool
    {
        return is_array($order)
            && count($order) === count(self::LANDING_SECTION_ORDER)
            && ! array_diff(self::LANDING_SECTION_ORDER, $order)
            && ! array_diff($order, self::LANDING_SECTION_ORDER);
    }

    public function uploadPhoto(Request $request): JsonResponse
    {
        $key = $request->string('photo_key')->toString();
        $isAudio = in_array($key, self::LANDING_AUDIO_KEYS, true);
        $data = $request->validate([
            'photo_key' => ['required', Rule::in([...self::LANDING_PHOTO_KEYS, ...self::LANDING_AUDIO_KEYS])],
            'photo' => $isAudio
                ? ['required', 'file', 'mimes:mp3', 'max:10240']
                : ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
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
