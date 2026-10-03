<?php

namespace App\Http\Controllers;

use App\Models\LandingGalleryItem;
use App\Models\RsvpMessage;
use App\Models\Setting;
use App\Support\AuditLogger;
use Illuminate\Database\Eloquent\Builder;
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
        'hero', 'couple', 'countdown', 'story', 'video', 'cta', 'event', 'schedule', 'people', 'cta_gallery', 'penutup',
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
        'landing_countdown_background', 'landing_cta_background', 'landing_cta_gallery_background', 'landing_penutup_background', 'landing_rsvp_background', 'landing_footer_background',
    ];

    private const LANDING_AUDIO_KEYS = ['landing_music_file'];

    private const LANDING_VIDEO_KEYS = ['landing_video_file'];

    public function edit(Request $request): View
    {
        $settings = Setting::query()->pluck('value', 'key');
        $settings['landing_guest_greeting'] ??= 'Kepada Yth.';
        $settings['landing_guest_apology'] ??= 'Mohon maaf apabila ada kesalahan penulisan nama/alamat.';
        $settings['landing_guest_message_template'] ??= "Halo {{nama}},\n\nKami mengundang Anda untuk hadir di acara pernikahan kami.\n\nBuka undangan: {{link}}";
        $sectionOrder = $this->sectionOrder($settings->get('landing_section_order'));
        $galleryItems = LandingGalleryItem::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
        $rsvpMessageSearch = $request->string('rsvp_search')->trim()->toString();
        $rsvpMessages = RsvpMessage::query()
            ->when($rsvpMessageSearch !== '', function (Builder $query) use ($rsvpMessageSearch): void {
                $query->where(function (Builder $query) use ($rsvpMessageSearch): void {
                    $query
                        ->where('name', 'like', '%'.$rsvpMessageSearch.'%')
                        ->orWhere('message', 'like', '%'.$rsvpMessageSearch.'%');
                });
            })
            ->latest()
            ->get();

        return view('admin.landing-settings', compact('settings', 'sectionOrder', 'galleryItems', 'rsvpMessages', 'rsvpMessageSearch'));
    }

    public function update(Request $request): RedirectResponse
    {
        $selectedSection = $request->validate([
            'save_section' => ['required', Rule::in(['guest_message', ...self::LANDING_SECTION_ORDER, 'order'])],
        ])['save_section'];

        if ($selectedSection === 'guest_message') {
            $data = $request->validate([
                'landing_guest_message_template' => ['required', 'string', 'max:2000'],
            ]);

            Setting::updateOrCreate(
                ['key' => 'landing_guest_message_template'],
                ['value' => $data['landing_guest_message_template']],
            );

            AuditLogger::record('landing_settings.updated', 'Format pesan WhatsApp diperbarui.', null, [], ['keys' => array_keys($data)]);

            return back()->with('success', 'Format pesan WhatsApp berhasil disimpan.');
        }

        $rules = [
            'landing_page_title' => ['required', 'string', 'max:160'],
            'landing_hero_subtitle' => ['required', 'string', 'max:120'],
            'landing_hero_title' => ['required', 'string', 'max:120'],
            'landing_hero_date' => ['required', 'string', 'max:120'],
            'landing_guest_greeting' => ['required', 'string', 'max:120'],
            'landing_guest_apology' => ['required', 'string', 'max:500'],
            'landing_guest_message_template' => ['required', 'string', 'max:2000'],
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
            'landing_video_title' => ['required', 'string', 'max:120'],
            'landing_video_source' => ['required', Rule::in(['upload', 'youtube'])],
            'landing_video_youtube_url' => ['nullable', 'url', 'max:2048'],
            'landing_video_file' => ['nullable', 'file', 'mimes:mp4,webm,ogg', 'max:102400'],
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
            'landing_gallery_columns' => ['required', 'integer', 'between:1,6'],
            'landing_gift_title' => ['required', 'string', 'max:120'],
            'landing_rsvp_description' => ['required', 'string', 'max:1000'],
            'landing_gift_description' => ['required', 'string', 'max:1000'],
            'landing_gift_bank_name' => ['required', 'string', 'max:80'],
            'landing_gift_account_number' => ['required', 'string', 'max:40'],
            'landing_gift_account_holder' => ['required', 'string', 'max:120'],
            'landing_rsvp_title' => ['required', 'string', 'max:120'],
            'landing_footer_title' => ['required', 'string', 'max:120'],
            'landing_footer_description' => ['required', 'string', 'max:1000'],
            'landing_footer_description_font_size' => ['required', 'integer', 'between:12,48'],
            'landing_footer_description_font_family' => ['required', Rule::in(['inherit', 'Arial, sans-serif', 'Georgia, serif', 'Trebuchet MS, sans-serif', 'Courier New, monospace'])],
            'landing_section_hero' => ['required', 'boolean'],
            'landing_section_couple' => ['required', 'boolean'],
            'landing_section_countdown' => ['required', 'boolean'],
            'landing_section_story' => ['required', 'boolean'],
            'landing_section_video' => ['required', 'boolean'],
            'landing_section_penutup' => ['required', 'boolean'],
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
                'landing_guest_greeting' => ['type' => 'string', 'max' => 120],
                'landing_guest_apology' => ['type' => 'string', 'max' => 500],
                'landing_guest_message_template' => ['type' => 'string', 'max' => 2000],
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
            'video' => [
                'landing_video_title' => ['type' => 'string', 'max' => 120],
                'landing_video_source' => ['type' => 'string', 'max' => 20],
                'landing_video_youtube_url' => ['type' => 'url', 'max' => 2048],
            ],
            'penutup' => [
                'landing_penutup_title' => ['type' => 'string', 'max' => 120],
                'landing_penutup_text' => ['type' => 'string', 'max' => 1000],
                'landing_penutup_button_label' => ['type' => 'string', 'max' => 80],
                'landing_penutup_button_url' => ['type' => 'string', 'max' => 2048],
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
            'rsvp' => [
                'landing_rsvp_title' => ['type' => 'string', 'max' => 120],
                'landing_rsvp_description' => ['type' => 'string', 'max' => 1000],
            ],
            'gift' => [
                'landing_gift_title' => ['type' => 'string', 'max' => 120],
                'landing_gift_description' => ['type' => 'string', 'max' => 1000],
                'landing_gift_bank_name' => ['type' => 'string', 'max' => 80],
                'landing_gift_account_number' => ['type' => 'string', 'max' => 40],
                'landing_gift_account_holder' => ['type' => 'string', 'max' => 120],
            ],
            'gallery' => [
                'landing_gallery_title' => ['type' => 'string', 'max' => 120],
                'landing_gallery_columns' => ['type' => 'integer', 'max' => 6],
            ],
            'rsvp' => [
                'landing_rsvp_title' => ['type' => 'string', 'max' => 120],
            ],
            'footer' => [
                'landing_footer_title' => ['type' => 'string', 'max' => 120],
                'landing_footer_description' => ['type' => 'string', 'max' => 1000],
                'landing_footer_description_font_size' => ['type' => 'integer', 'max' => 48],
                'landing_footer_description_font_family' => ['type' => 'string', 'max' => 40],
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

        $rules['landing_video_youtube_url'] = [
            Rule::requiredIf($request->boolean('landing_section_video') && $request->input('landing_video_source') === 'youtube'),
            'nullable',
            'url',
            'max:2048',
        ];

        $rules['landing_gallery_columns'] = [
            Rule::requiredIf($request->boolean('landing_section_gallery')),
            'nullable',
            'integer',
            'between:1,6',
        ];

        foreach (['landing_guest_greeting' => 120, 'landing_guest_apology' => 500, 'landing_guest_message_template' => 2000] as $field => $maxLength) {
            $rules[$field] = [
                Rule::requiredIf($request->has($field)),
                'nullable',
                'string',
                'max:'.$maxLength,
            ];
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
            $locationButtonIsEnabled = $scheduleIsEnabled
                && $request->boolean('landing_schedule_'.$number.'_location_enabled');

            $rules['landing_schedule_'.$number.'_location_enabled'] = ['required', 'boolean'];

            foreach ([
                'name' => 120,
                'date' => 120,
                'time' => 80,
                'location' => 255,
                'location_url' => 2048,
            ] as $field => $maxLength) {
                $fieldIsRequired = $field === 'location_url'
                    ? $locationButtonIsEnabled
                    : $scheduleIsEnabled;

                $rules['landing_schedule_'.$number.'_'.$field] = [
                    $fieldIsRequired ? 'required' : 'nullable',
                    'nullable',
                    $field === 'location_url' ? 'url' : 'string',
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
            'guest_message' => ['landing_guest_message_template'],
            'hero' => ['landing_section_hero', 'landing_page_title', 'landing_hero_subtitle', 'landing_hero_title', 'landing_hero_date', 'landing_guest_greeting', 'landing_guest_apology', 'landing_guest_message_template', 'landing_hero_background'],
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
            'rsvp' => ['landing_section_rsvp', 'landing_rsvp_title', 'landing_rsvp_description', 'landing_rsvp_background'],
            'story' => ['landing_section_story', 'landing_story_title', ...array_merge(
                ...array_map(fn (int $number): array => [
                    'landing_story_'.$number.'_enabled',
                    'landing_story_'.$number.'_title',
                    'landing_story_'.$number.'_date',
                    'landing_story_'.$number.'_text',
                    'landing_story_photo_'.$number,
                ], range(1, 4)),
            )],
            'video' => ['landing_section_video', 'landing_video_title', 'landing_video_source', 'landing_video_youtube_url', 'landing_video_file'],
            'penutup' => ['landing_section_penutup', 'landing_penutup_title', 'landing_penutup_text', 'landing_penutup_button_label', 'landing_penutup_button_url', 'landing_penutup_background'],
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
                    'landing_schedule_'.$number.'_location_enabled',
                    'landing_schedule_'.$number.'_location_url',
                ], range(1, 6)),
            )],
            'people' => ['landing_section_people', 'landing_people_title'],
            'cta_gallery' => ['landing_section_cta_gallery', 'landing_cta_gallery_title', 'landing_cta_gallery_text', 'landing_cta_gallery_rsvp_label', 'landing_cta_gallery_rsvp_url', 'landing_cta_gallery_location_label', 'landing_cta_gallery_location_url', 'landing_cta_gallery_rsvp_enabled', 'landing_cta_gallery_location_enabled', 'landing_cta_gallery_background'],
            'gallery' => ['landing_section_gallery', 'landing_gallery_title', 'landing_gallery_columns', ...array_map(fn (int $number): string => 'landing_gallery_photo_'.$number, range(1, 6))],
            'gta' => ['landing_section_gta'],
            'gift' => ['landing_section_gift', 'landing_gift_title', 'landing_gift_description', 'landing_gift_bank_name', 'landing_gift_account_number', 'landing_gift_account_holder'],
            'music' => ['landing_section_music', 'landing_music_file'],
            'footer' => ['landing_section_footer', 'landing_footer_title', 'landing_footer_description', 'landing_footer_description_font_size', 'landing_footer_description_font_family', 'landing_footer_background'],
            'order' => ['landing_section_order'],
        ];

        $section = $selectedSection;
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

        foreach ([...self::LANDING_AUDIO_KEYS, ...self::LANDING_VIDEO_KEYS] as $key) {
            if (! $request->hasFile($key)) {
                unset($data[$key]);

                continue;
            }

            $oldAudio = Setting::value($key);
            $newMedia = $request->file($key)->store('landing', 'public');
            if (is_string($oldAudio) && str_starts_with($oldAudio, 'landing/')) {
                Storage::disk('public')->delete($oldAudio);
            }
            $data[$key] = $newMedia;
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
        $isVideo = in_array($key, self::LANDING_VIDEO_KEYS, true);
        $data = $request->validate([
            'photo_key' => ['required', Rule::in([...self::LANDING_PHOTO_KEYS, ...self::LANDING_AUDIO_KEYS, ...self::LANDING_VIDEO_KEYS])],
            'photo' => $isAudio
                ? ['required', 'file', 'mimes:mp3', 'max:10240']
                : ($isVideo
                    ? ['required', 'file', 'mimes:mp4,webm,ogg', 'max:102400']
                    : ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']),
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

    public function storeGalleryItem(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        LandingGalleryItem::query()->create([
            'image_path' => $request->file('photo')->store('landing/gallery', 'public'),
            'category' => 'Galeri',
            'sort_order' => (int) LandingGalleryItem::query()->max('sort_order') + 1,
        ]);

        AuditLogger::record('landing_gallery.created', 'Foto galeri landing page ditambahkan.');

        return back()->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function updateGalleryItem(Request $request, LandingGalleryItem $galleryItem): RedirectResponse
    {
        $data = $request->validate([
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $newPhoto = $request->file('photo')->store('landing/gallery', 'public');
            Storage::disk('public')->delete($galleryItem->image_path);
            $data['image_path'] = $newPhoto;
        }

        $galleryItem->update($data);
        AuditLogger::record('landing_gallery.updated', 'Foto galeri landing page diperbarui.', $galleryItem);

        return back()->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroyGalleryItem(LandingGalleryItem $galleryItem): RedirectResponse
    {
        Storage::disk('public')->delete($galleryItem->image_path);
        $galleryItem->delete();
        AuditLogger::record('landing_gallery.deleted', 'Foto galeri landing page dihapus.', $galleryItem);

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}
