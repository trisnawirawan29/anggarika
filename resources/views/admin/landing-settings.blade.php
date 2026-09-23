@extends('layouts.admin')
@section('title', 'Pengaturan Landing Page')
@section('page-title', 'Pengaturan Landing Page')
@section('page-subtitle', 'Atur setiap section landing page secara terpisah. Maksimal 2 MB per foto; foto dikompres otomatis sebelum disimpan.')
@section('content')
@php
    $photoUrl = fn (array $photo): string => str_starts_with($settings[$photo['key']] ?? '', 'landing/') ? asset('storage/'.$settings[$photo['key']]) : asset($photo['default']);
    $photo = fn (string $key, string $label, string $default): array => ['key' => $key, 'label' => $label, 'default' => $default];
@endphp
<style>
    .settings-shell form > .content-card {
        height: auto !important;
    }

    .settings-shell form > .content-card:first-of-type .row.g-4.mt-1 {
        margin-top: 1rem !important;
    }

    .settings-shell form > .content-card:first-of-type .row.g-4.mt-1 > div {
        width: min(100%, 360px);
    }

    .settings-shell form > .content-card:first-of-type .row.g-4.mt-1 img {
        display: block;
        width: 100%;
        height: 190px !important;
        object-fit: cover;
        background: #f4f6fa;
    }

    .settings-shell input[type='file'] {
        min-width: 0;
    }

    .landing-settings-section .section-title {
        cursor: pointer;
    }

    .landing-section-toggle {
        margin-left: auto;
        border: 0;
        background: #f4f3ff;
        color: #6c63ff;
        border-radius: 8px;
        width: 32px;
        height: 32px;
    }

    .landing-settings-section.is-collapsed {
        padding-bottom: 16px;
    }

    .landing-settings-tabs .nav-link {
        position: relative;
        width: 100%;
        text-align: left;
        color: #6c63ff;
        background: #f4f3ff;
        border: 0;
        border-radius: 8px;
    }

    .landing-settings-tabs .nav-link.active {
        color: #fff;
        background: #6c63ff;
    }

    .landing-wizard-navigation {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 1rem;
    }

    .landing-wizard-layout {
        display: grid;
        grid-template-columns: 280px minmax(0, 1fr);
        gap: 28px;
        align-items: start;
    }

    .landing-wizard-sidebar {
        position: sticky;
        top: 20px;
        padding: 18px;
        background: #fff;
        border: 1px solid #e9e7f5;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(35, 31, 77, .06);
    }

    .landing-wizard-sidebar::before {
        display: block;
        margin-bottom: 14px;
        color: #25213f;
        content: 'Langkah pengaturan';
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .landing-wizard-content > .content-card {
        border: 1px solid #e9e7f5;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(35, 31, 77, .06);
        padding: 24px;
    }

    .landing-settings-tabs .nav-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px 13px;
        font-weight: 600;
        transition: .2s ease;
    }

    .landing-settings-tabs .nav-link:hover {
        transform: translateX(3px);
    }

    .landing-settings-tabs .nav-link.active .badge {
        color: #6c63ff !important;
        background: #fff !important;
    }

    .landing-wizard-content .section-title {
        margin-bottom: 24px;
    }

    [data-bs-theme="dark"] .landing-wizard-sidebar,
    [data-bs-theme="dark"] .landing-wizard-content > .content-card {
        background: #1f2430;
        border-color: #3b4354;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
    }

    [data-bs-theme="dark"] .landing-wizard-sidebar::before,
    [data-bs-theme="dark"] .landing-wizard-content .section-title h5 {
        color: #f1f3f8;
    }

    [data-bs-theme="dark"] .landing-settings-tabs .nav-link {
        color: #c9c5ff;
        background: #2b3241;
    }

    [data-bs-theme="dark"] .landing-settings-tabs .nav-link.active {
        color: #fff;
        background: #6c63ff;
    }

    [data-bs-theme="dark"] .landing-settings-tabs .nav-link.active .badge {
        color: #6c63ff !important;
    }
    }

    @media (max-width: 991px) {
        .landing-wizard-layout {
            grid-template-columns: 1fr;
        }

        .landing-wizard-sidebar {
            position: static;
            padding: 14px;
        }

        .landing-settings-tabs {
            flex-direction: row !important;
        }

        .landing-settings-tabs .nav-link {
            width: auto;
        }
    }
</style>
<div class="settings-shell">
    <div class="alert alert-info small"><i class="fas fa-circle-info me-2"></i>Ukuran setiap foto maksimal 2 MB. File yang lebih besar akan ditolak.</div>
    @if (session('success'))<div class="alert alert-success small">{{ session('success') }}</div>@endif
    @if ($errors->any())<div class="alert alert-danger small">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('admin.landing-settings.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="content-card mb-4"><div class="section-title"><span class="section-number">01</span><div><h5>Hero</h5><p>Judul halaman, teks pembuka, dan foto utama.</p></div></div><div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_hero" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_hero" name="landing_section_hero" value="1" @checked(old('landing_section_hero', $settings['landing_section_hero'] ?? '1'))><label class="form-check-label" for="landing_section_hero">Tampilkan hero</label></div><div class="row g-3"><div class="col-md-6"><label class="form-label">Judul halaman/aplikasi</label><input name="landing_page_title" class="form-control" value="{{ old('landing_page_title', $settings['landing_page_title'] ?? 'Millar & Aliza · Wedding Invitation') }}" required></div><div class="col-md-6"><label class="form-label">Subjudul hero</label><input name="landing_hero_subtitle" class="form-control" value="{{ old('landing_hero_subtitle', $settings['landing_hero_subtitle'] ?? 'WERE GETTING MARRIED') }}" required></div><div class="col-md-6"><label class="form-label">Judul hero</label><input name="landing_hero_title" class="form-control" value="{{ old('landing_hero_title', $settings['landing_hero_title'] ?? 'Save Our Date') }}" required></div><div class="col-md-6"><label class="form-label">Tanggal hero</label><input name="landing_hero_date" class="form-control" value="{{ old('landing_hero_date', $settings['landing_hero_date'] ?? '25 December 2019') }}" required></div></div><div class="row g-4 mt-1"><div class="col-6 col-md-3"><img src="{{ $photoUrl($photo('landing_hero_background', 'Background hero', 'assets/images/slider/slide-4.jpg')) }}" class="w-100 rounded mb-2" style="height:150px;object-fit:cover"><label class="form-label small">Background hero</label><input type="file" name="landing_hero_background" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp"></div></div></div>

        <div class="content-card mb-4"><div class="section-title"><span class="section-number">02</span><div><h5>Pasangan</h5><p>Profil dan foto kedua mempelai.</p></div></div><div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_couple" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_couple" name="landing_section_couple" value="1" @checked(old('landing_section_couple', $settings['landing_section_couple'] ?? '1'))><label class="form-check-label" for="landing_section_couple">Tampilkan pasangan</label></div><div class="row g-3"><div class="col-md-4"><label class="form-label">Judul</label><input name="landing_couple_title" class="form-control" value="{{ old('landing_couple_title', $settings['landing_couple_title'] ?? 'Happy Couple') }}" required></div><div class="col-md-4"><label class="form-label">Nama wanita</label><input name="landing_bride_name" class="form-control" value="{{ old('landing_bride_name', $settings['landing_bride_name'] ?? 'Aliza Elizabeth') }}" required></div><div class="col-md-4"><label class="form-label">Nama pria</label><input name="landing_groom_name" class="form-control" value="{{ old('landing_groom_name', $settings['landing_groom_name'] ?? 'Millar Wiliam') }}" required></div><div class="col-md-6"><label class="form-label">Bio wanita</label><textarea name="landing_bride_bio" class="form-control" rows="3" required>{{ old('landing_bride_bio', $settings['landing_bride_bio'] ?? 'Hi, I am Aliza Elizabeth. Thank you for being part of our special day.') }}</textarea></div><div class="col-md-6"><label class="form-label">Bio pria</label><textarea name="landing_groom_bio" class="form-control" rows="3" required>{{ old('landing_groom_bio', $settings['landing_groom_bio'] ?? 'Hi, I am Millar Wiliam. We are delighted to celebrate this moment with you.') }}</textarea></div></div><div class="row g-4 mt-1">@foreach ([$photo('landing_bride_photo', 'Foto wanita', 'assets/images/story/1.jpg'), $photo('landing_groom_photo', 'Foto pria', 'assets/images/story/2.jpg')] as $item)<div class="col-6 col-md-3"><img src="{{ $photoUrl($item) }}" class="w-100 rounded mb-2" style="height:150px;object-fit:cover"><label class="form-label small">{{ $item['label'] }}</label><input type="file" name="{{ $item['key'] }}" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp"></div>@endforeach</div></div>

        <div class="content-card mb-4">
            <div class="section-title"><span class="section-number">02A</span><div><h5>Tipografi nama pasangan</h5><p>Atur ukuran dan jenis font nama Pria serta Wanita.</p></div></div>
            <div class="row g-3">
                @foreach ([['key' => 'groom', 'label' => 'Pria'], ['key' => 'bride', 'label' => 'Wanita']] as $person)
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <h6>{{ $person['label'] }}</h6>
                            <label class="form-label">Ukuran nama (px)</label>
                            <input type="number" name="landing_{{ $person['key'] }}_name_font_size" class="form-control mb-2" min="16" max="96" value="{{ old('landing_'.$person['key'].'_name_font_size', $settings['landing_'.$person['key'].'_name_font_size'] ?? '32') }}">
                            <label class="form-label">Jenis font</label>
                            <select name="landing_{{ $person['key'] }}_name_font_family" class="form-select">
                                @foreach (['inherit' => 'Mengikuti desain', 'Arial, sans-serif' => 'Arial', 'Georgia, serif' => 'Georgia', 'Trebuchet MS, sans-serif' => 'Trebuchet MS', 'Courier New, monospace' => 'Courier New'] as $fontValue => $fontLabel)
                                    <option value="{{ $fontValue }}" @selected(old('landing_'.$person['key'].'_name_font_family', $settings['landing_'.$person['key'].'_name_font_family'] ?? 'inherit') === $fontValue)>{{ $fontLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="content-card mb-4">
            <div class="section-title"><span class="section-number">02B</span><div><h5>Sosial media pasangan</h5><p>Atur link dan tampil/sembunyi tombol sosial media masing-masing.</p></div></div>
            @foreach ([['key' => 'groom', 'label' => 'Pria'], ['key' => 'bride', 'label' => 'Wanita']] as $person)
                <h6 class="mt-3">{{ $person['label'] }}</h6>
                <div class="row g-3">
                    @foreach ([['key' => 'facebook', 'label' => 'Facebook', 'icon' => 'ti-facebook'], ['key' => 'twitter', 'label' => 'Twitter', 'icon' => 'ti-twitter'], ['key' => 'instagram', 'label' => 'Instagram', 'icon' => 'ti-instagram'], ['key' => 'linkedin', 'label' => 'LinkedIn', 'icon' => 'ti-linkedin']] as $network)
                        @php
                            $socialEnabledKey = 'landing_'.$person['key'].'_'.$network['key'].'_enabled';
                            $socialUrlKey = 'landing_'.$person['key'].'_'.$network['key'].'_url';
                        @endphp
                        <div class="col-md-6">
                            <div class="border rounded p-3">
                                <div class="form-check form-switch mb-2"><input type="hidden" name="{{ $socialEnabledKey }}" value="0"><input class="form-check-input" type="checkbox" role="switch" id="{{ $socialEnabledKey }}" name="{{ $socialEnabledKey }}" value="1" @checked(filter_var(old($socialEnabledKey, $settings[$socialEnabledKey] ?? '1'), FILTER_VALIDATE_BOOLEAN))><label class="form-check-label" for="{{ $socialEnabledKey }}">Tampilkan {{ $network['label'] }}</label></div>
                                <label class="form-label">Username / link {{ $network['label'] }}</label>
                                <input data-social-field name="{{ $socialUrlKey }}" class="form-control" value="{{ old($socialUrlKey, $settings[$socialUrlKey] ?? '#') }}" @required(filter_var(old($socialEnabledKey, $settings[$socialEnabledKey] ?? '1'), FILTER_VALIDATE_BOOLEAN))>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        @foreach ([
            ['key' => 'countdown', 'title' => 'Countdown', 'label' => 'Tampilkan countdown', 'photo' => ['landing_countdown_background', 'Background countdown', 'assets/images/counter/1.jpg']],
            ['key' => 'cta', 'title' => 'CTA', 'label' => 'Tampilkan CTA', 'photo' => ['landing_cta_background', 'Background CTA', 'assets/images/cta/img-1.jpg']],
            ['key' => 'rsvp', 'title' => 'RSVP', 'label' => 'Tampilkan RSVP', 'photo' => ['landing_rsvp_background', 'Background RSVP', 'assets/images/rsvp/img-1.jpg']],
        ] as $item)
            <div class="content-card mb-4">
                <div class="section-title"><span class="section-number">03</span><div><h5>{{ $item['title'] }}</h5><p>Pengaturan section {{ $item['title'] }}.</p></div></div>
                <div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_{{ $item['key'] }}" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_{{ $item['key'] }}" name="landing_section_{{ $item['key'] }}" value="1" @checked(old('landing_section_'.$item['key'], $settings['landing_section_'.$item['key']] ?? '1'))><label class="form-check-label" for="landing_section_{{ $item['key'] }}">{{ $item['label'] }}</label></div>
                @if ($item['key'] === 'countdown')
                    <label class="form-label">Tanggal countdown</label>
                    <input type="datetime-local" name="landing_countdown_date" class="form-control mb-3" value="{{ old('landing_countdown_date', $settings['landing_countdown_date'] ?? '2026-12-31T00:00') }}" required>
                @endif
                @if ($item['key'] === 'cta')
                    <div class="row g-3 mb-3">
                        <div class="col-md-6"><label class="form-label">Judul CTA</label><input name="landing_cta_title" class="form-control" value="{{ old('landing_cta_title', $settings['landing_cta_title'] ?? 'Welcome to our big day') }}" required></div>
                        <div class="col-md-6"><label class="form-label">Teks tombol RSVP</label><input name="landing_cta_rsvp_label" class="form-control" value="{{ old('landing_cta_rsvp_label', $settings['landing_cta_rsvp_label'] ?? 'RSVP') }}" required></div>
                        <div class="col-md-6"><label class="form-label">URL tombol RSVP</label><input name="landing_cta_rsvp_url" class="form-control" value="{{ old('landing_cta_rsvp_url', $settings['landing_cta_rsvp_url'] ?? '#rsvp') }}" required></div>
                        <div class="col-12"><label class="form-label">Deskripsi CTA</label><textarea name="landing_cta_text" class="form-control" rows="3" required>{{ old('landing_cta_text', $settings['landing_cta_text'] ?? '') }}</textarea></div>
                        <div class="col-md-4"><label class="form-label">Teks tombol lokasi</label><input name="landing_cta_location_label" class="form-control" value="{{ old('landing_cta_location_label', $settings['landing_cta_location_label'] ?? 'Location') }}" required></div>
                        <div class="col-md-8"><label class="form-label">URL lokasi / Google Maps</label><input type="url" name="landing_cta_location_url" class="form-control" value="{{ old('landing_cta_location_url', $settings['landing_cta_location_url'] ?? '') }}" required></div>
                        <div class="col-md-6"><div class="form-check form-switch"><input type="hidden" name="landing_cta_rsvp_enabled" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_cta_rsvp_enabled" name="landing_cta_rsvp_enabled" value="1" @checked(filter_var(old('landing_cta_rsvp_enabled', $settings['landing_cta_rsvp_enabled'] ?? '1'), FILTER_VALIDATE_BOOLEAN))><label class="form-check-label" for="landing_cta_rsvp_enabled">Tampilkan tombol RSVP</label></div></div>
                        <div class="col-md-6"><div class="form-check form-switch"><input type="hidden" name="landing_cta_location_enabled" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_cta_location_enabled" name="landing_cta_location_enabled" value="1" @checked(filter_var(old('landing_cta_location_enabled', $settings['landing_cta_location_enabled'] ?? '1'), FILTER_VALIDATE_BOOLEAN))><label class="form-check-label" for="landing_cta_location_enabled">Tampilkan tombol lokasi</label></div></div>
                    </div>
                @endif
                @if ($item['key'] === 'rsvp')
                    <label class="form-label">Judul RSVP</label>
                    <input name="landing_rsvp_title" class="form-control mb-3" value="{{ old('landing_rsvp_title', $settings['landing_rsvp_title'] ?? 'Be Our RSVP') }}" required>
                @endif
                <div class="row g-4"><div class="col-6 col-md-3">
                    @php
                        $itemPhoto = $photo($item['photo'][0], $item['photo'][1], $item['photo'][2]);
                    @endphp
                    <img src="{{ $photoUrl($itemPhoto) }}" class="w-100 rounded mb-2" style="height:150px;object-fit:cover">
                    <label class="form-label small">{{ $item['photo'][1] }}</label>
                    <input type="file" name="{{ $item['photo'][0] }}" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                </div></div>
            </div>
        @endforeach

        <div class="content-card mb-4">
            <div class="section-title"><span class="section-number">04</span><div><h5>Cerita</h5><p>Atur judul section, isi teks, foto, dan visibility setiap cerita.</p></div></div>
            <div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_story" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_story" name="landing_section_story" value="1" @checked(old('landing_section_story', $settings['landing_section_story'] ?? '1'))><label class="form-check-label" for="landing_section_story">Tampilkan section cerita</label></div>
            <label class="form-label">Judul section cerita</label>
            <input name="landing_story_title" class="form-control mb-4" value="{{ old('landing_story_title', $settings['landing_story_title'] ?? 'Our love story') }}" required>
            @foreach (range(1, 4) as $number)
                @php
                    $storyPhoto = $photo('landing_story_photo_'.$number, 'Foto cerita '.$number, 'assets/images/story/img-'.$number.'.jpg');
                @endphp
                <div class="border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Cerita {{ $number }}</h6>
                        <div class="form-check form-switch mb-0">
                            <input type="hidden" name="landing_story_{{ $number }}_enabled" value="0">
                            <input class="form-check-input" type="checkbox" role="switch" id="landing_story_{{ $number }}_enabled" name="landing_story_{{ $number }}_enabled" value="1" @checked(filter_var(old('landing_story_'.$number.'_enabled', $settings['landing_story_'.$number.'_enabled'] ?? '1'), FILTER_VALIDATE_BOOLEAN))>
                            <label class="form-check-label" for="landing_story_{{ $number }}_enabled">Tampilkan cerita</label>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4"><label class="form-label">Judul cerita {{ $number }}</label><input data-story-field name="landing_story_{{ $number }}_title" class="form-control" value="{{ old('landing_story_'.$number.'_title', $settings['landing_story_'.$number.'_title'] ?? '') }}" @required(filter_var(old('landing_story_'.$number.'_enabled', $settings['landing_story_'.$number.'_enabled'] ?? '1'), FILTER_VALIDATE_BOOLEAN))></div>
                        <div class="col-md-4"><label class="form-label">Tanggal cerita {{ $number }}</label><input data-story-field name="landing_story_{{ $number }}_date" class="form-control" value="{{ old('landing_story_'.$number.'_date', $settings['landing_story_'.$number.'_date'] ?? '') }}" @required(filter_var(old('landing_story_'.$number.'_enabled', $settings['landing_story_'.$number.'_enabled'] ?? '1'), FILTER_VALIDATE_BOOLEAN))></div>
                        <div class="col-md-4"><img src="{{ $photoUrl($storyPhoto) }}" class="w-100 rounded" style="height:120px;object-fit:cover" alt="Preview foto cerita {{ $number }}"></div>
                        <div class="col-md-8"><label class="form-label">Teks cerita {{ $number }}</label><textarea data-story-field name="landing_story_{{ $number }}_text" class="form-control" rows="4" @required(filter_var(old('landing_story_'.$number.'_enabled', $settings['landing_story_'.$number.'_enabled'] ?? '1'), FILTER_VALIDATE_BOOLEAN))>{{ old('landing_story_'.$number.'_text', $settings['landing_story_'.$number.'_text'] ?? '') }}</textarea></div>
                        <div class="col-md-4"><label class="form-label">Foto cerita {{ $number }}</label><input type="file" name="{{ $storyPhoto['key'] }}" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp"><small class="text-muted">Maksimal 2 MB.</small></div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="content-card mb-4"><div class="section-title"><span class="section-number">05</span><div><h5>Acara</h5><p>Judul dan foto setiap acara.</p></div></div><div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_event" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_event" name="landing_section_event" value="1" @checked(old('landing_section_event', $settings['landing_section_event'] ?? '1'))><label class="form-check-label" for="landing_section_event">Tampilkan acara</label></div><label class="form-label">Judul acara</label><input name="landing_event_title" class="form-control mb-3" value="{{ old('landing_event_title', $settings['landing_event_title'] ?? 'When & Where') }}" required><div class="row g-4">@foreach ([[$photo('landing_event_photo_1', 'Acara 1', 'assets/images/events/img-1.jpg')], [$photo('landing_event_photo_2', 'Acara 2', 'assets/images/events/img-2.jpg')], [$photo('landing_event_photo_3', 'Acara 3', 'assets/images/events/img-3.jpg')], [$photo('landing_event_photo_4', 'Acara 4', 'assets/images/events/img-4.jpg')]] as $item)<div class="col-6 col-md-3">@php($item = $item[0])<img src="{{ $photoUrl($item) }}" class="w-100 rounded mb-2" style="height:150px;object-fit:cover"><label class="form-label small">{{ $item['label'] }}</label><input type="file" name="{{ $item['key'] }}" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp"></div>@endforeach</div></div>

        <div class="content-card mb-4"><div class="section-title"><span class="section-number">06</span><div><h5>Keluarga & teman</h5><p>Pengaturan section orang-orang terdekat.</p></div></div><div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_people" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_people" name="landing_section_people" value="1" @checked(old('landing_section_people', $settings['landing_section_people'] ?? '1'))><label class="form-check-label" for="landing_section_people">Tampilkan keluarga & teman</label></div><label class="form-label">Judul section</label><input name="landing_people_title" class="form-control" value="{{ old('landing_people_title', $settings['landing_people_title'] ?? 'Groomsmen & Bridesmaid') }}" required></div>

        <div class="content-card mb-4">
            <div class="section-title"><span class="section-number">07</span><div><h5>CTA sebelum galeri</h5><p>CTA tambahan yang tampil tepat di atas section galeri.</p></div></div>
            <div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_cta_gallery" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_cta_gallery" name="landing_section_cta_gallery" value="1" @checked(old('landing_section_cta_gallery', $settings['landing_section_cta_gallery'] ?? '1'))><label class="form-check-label" for="landing_section_cta_gallery">Tampilkan CTA sebelum galeri</label></div>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Judul CTA</label><input name="landing_cta_gallery_title" class="form-control" value="{{ old('landing_cta_gallery_title', $settings['landing_cta_gallery_title'] ?? 'Welcome to our big day') }}" required></div>
                <div class="col-md-6"><label class="form-label">Teks tombol RSVP</label><input name="landing_cta_gallery_rsvp_label" class="form-control" value="{{ old('landing_cta_gallery_rsvp_label', $settings['landing_cta_gallery_rsvp_label'] ?? 'RSVP') }}" required></div>
                <div class="col-md-6"><label class="form-label">URL tombol RSVP</label><input name="landing_cta_gallery_rsvp_url" class="form-control" value="{{ old('landing_cta_gallery_rsvp_url', $settings['landing_cta_gallery_rsvp_url'] ?? '#rsvp') }}" required></div>
                <div class="col-12"><label class="form-label">Deskripsi CTA</label><textarea name="landing_cta_gallery_text" class="form-control" rows="3" required>{{ old('landing_cta_gallery_text', $settings['landing_cta_gallery_text'] ?? '') }}</textarea></div>
                <div class="col-md-4"><label class="form-label">Teks tombol lokasi</label><input name="landing_cta_gallery_location_label" class="form-control" value="{{ old('landing_cta_gallery_location_label', $settings['landing_cta_gallery_location_label'] ?? 'Location') }}" required></div>
                <div class="col-md-8"><label class="form-label">URL lokasi / Google Maps</label><input type="url" name="landing_cta_gallery_location_url" class="form-control" value="{{ old('landing_cta_gallery_location_url', $settings['landing_cta_gallery_location_url'] ?? '') }}" required></div>
                <div class="col-md-6"><div class="form-check form-switch"><input type="hidden" name="landing_cta_gallery_rsvp_enabled" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_cta_gallery_rsvp_enabled" name="landing_cta_gallery_rsvp_enabled" value="1" @checked(filter_var(old('landing_cta_gallery_rsvp_enabled', $settings['landing_cta_gallery_rsvp_enabled'] ?? '1'), FILTER_VALIDATE_BOOLEAN))><label class="form-check-label" for="landing_cta_gallery_rsvp_enabled">Tampilkan tombol RSVP</label></div></div>
                <div class="col-md-6"><div class="form-check form-switch"><input type="hidden" name="landing_cta_gallery_location_enabled" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_cta_gallery_location_enabled" name="landing_cta_gallery_location_enabled" value="1" @checked(filter_var(old('landing_cta_gallery_location_enabled', $settings['landing_cta_gallery_location_enabled'] ?? '1'), FILTER_VALIDATE_BOOLEAN))><label class="form-check-label" for="landing_cta_gallery_location_enabled">Tampilkan tombol lokasi</label></div></div>
                <div class="col-6 col-md-3"><img src="{{ $photoUrl($photo('landing_cta_gallery_background', 'Background CTA sebelum galeri', 'assets/images/cta/img-1.jpg')) }}" class="w-100 rounded mb-2" style="height:150px;object-fit:cover"><label class="form-label small">Background CTA sebelum galeri</label><input type="file" name="landing_cta_gallery_background" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp"></div>
            </div>
        </div>

        <div class="content-card mb-4"><div class="section-title"><span class="section-number">08</span><div><h5>Galeri</h5><p>Judul dan foto galeri.</p></div></div><div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_gallery" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_gallery" name="landing_section_gallery" value="1" @checked(old('landing_section_gallery', $settings['landing_section_gallery'] ?? '1'))><label class="form-check-label" for="landing_section_gallery">Tampilkan galeri</label></div><label class="form-label">Judul galeri</label><input name="landing_gallery_title" class="form-control mb-3" value="{{ old('landing_gallery_title', $settings['landing_gallery_title'] ?? 'Our Gallery') }}" required><div class="row g-4">@foreach ([1, 2, 3, 4, 5, 6] as $number)@php($item = $photo('landing_gallery_photo_'.$number, 'Galeri '.$number, 'assets/images/gallery/img-'.$number.'.jpg'))<div class="col-6 col-md-3"><img src="{{ $photoUrl($item) }}" class="w-100 rounded mb-2" style="height:150px;object-fit:cover"><label class="form-label small">{{ $item['label'] }}</label><input type="file" name="{{ $item['key'] }}" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp"></div>@endforeach</div></div>

        @foreach ([['key' => 'gta', 'title' => 'Informasi perjalanan', 'label' => 'Tampilkan informasi perjalanan'], ['key' => 'gift', 'title' => 'Gift registration', 'label' => 'Tampilkan gift registration'], ['key' => 'music', 'title' => 'Music player', 'label' => 'Tampilkan music player']] as $item)<div class="content-card mb-4"><div class="section-title"><span class="section-number">08</span><div><h5>{{ $item['title'] }}</h5><p>Pengaturan section {{ $item['title'] }}.</p></div></div><div class="form-check form-switch"><input type="hidden" name="landing_section_{{ $item['key'] }}" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_{{ $item['key'] }}" name="landing_section_{{ $item['key'] }}" value="1" @checked(old('landing_section_'.$item['key'], $settings['landing_section_'.$item['key']] ?? '1'))><label class="form-check-label" for="landing_section_{{ $item['key'] }}">{{ $item['label'] }}</label></div></div>@endforeach

        <div class="content-card mb-4">
            <div class="section-title"><span class="section-number">10</span><div><h5>Upload music player</h5><p>Upload musik MP3 yang diputar saat landing page dibuka.</p></div></div>
            <div class="form-text mb-3">Format MP3, maksimal 10 MB. Fitur pemutaran mengikuti toggle Music player.</div>
            @if (!empty($settings['landing_music_file']))
                <audio controls class="w-100 mb-3" src="{{ str_starts_with($settings['landing_music_file'], 'landing/') ? asset('storage/'.$settings['landing_music_file']) : asset($settings['landing_music_file']) }}"></audio>
            @endif
            <label class="form-label">File musik MP3</label>
            <input type="file" name="landing_music_file" class="form-control form-control-sm" accept="audio/mpeg,.mp3" data-max-size="10485760">
        </div>

        <div class="content-card mb-4"><div class="section-title"><span class="section-number">09</span><div><h5>Footer</h5><p>Judul penutup dan background footer.</p></div></div><div class="form-check form-switch mb-3"><input type="hidden" name="landing_section_footer" value="0"><input class="form-check-input" type="checkbox" role="switch" id="landing_section_footer" name="landing_section_footer" value="1" @checked(old('landing_section_footer', $settings['landing_section_footer'] ?? '1'))><label class="form-check-label" for="landing_section_footer">Tampilkan footer</label></div><label class="form-label">Judul footer</label><input name="landing_footer_title" class="form-control mb-3" value="{{ old('landing_footer_title', $settings['landing_footer_title'] ?? 'Millar & Aliza Forever') }}" required><div class="row g-4"><div class="col-6 col-md-3"><img src="{{ $photoUrl($photo('landing_footer_background', 'Background footer', 'assets/images/footer-bg.jpg')) }}" class="w-100 rounded mb-2" style="height:150px;object-fit:cover"><label class="form-label small">Background footer</label><input type="file" name="landing_footer_background" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp"></div></div></div>

        <div class="d-flex justify-content-end"><button class="btn btn-primary px-4"><i class="fas fa-check me-2"></i>Simpan pengaturan landing page</button></div>
    </form>
</div>
<script>
    (() => {
        const form = document.querySelector('form[action="{{ route('admin.landing-settings.update') }}"]');
        let cards = [...(form?.querySelectorAll(':scope > .content-card') || [])];
        if (!form || !cards.length) {
            return;
        }

        const musicCard = cards.find((card) => card.querySelector('.section-title h5')?.textContent.trim() === 'Music player');
        const musicUploadCard = cards.find((card) => card.querySelector('.section-title h5')?.textContent.trim() === 'Upload music player');
        if (musicCard && musicUploadCard) {
            [...musicUploadCard.children]
                .filter((child) => !child.classList.contains('section-title'))
                .forEach((child) => musicCard.appendChild(child));
            musicUploadCard.remove();
            cards = cards.filter((card) => card !== musicUploadCard);
        }

        const coupleCard = cards.find((card) => card.querySelector('.section-title h5')?.textContent.trim() === 'Pasangan');
        const coupleSubCards = cards.filter((card) => ['Tipografi nama pasangan', 'Sosial media pasangan'].includes(card.querySelector('.section-title h5')?.textContent.trim()));
        if (coupleCard && coupleSubCards.length) {
            coupleSubCards.forEach((subCard) => {
                [...subCard.children]
                    .filter((child) => !child.classList.contains('section-title'))
                    .forEach((child) => coupleCard.appendChild(child));
                subCard.remove();
            });
            cards = cards.filter((card) => !coupleSubCards.includes(card));
        }

        const tabs = document.createElement('div');
        tabs.className = 'landing-settings-tabs nav nav-pills flex-column gap-2';

        const navigation = document.createElement('div');
        navigation.className = 'landing-wizard-navigation';
        const previousButton = document.createElement('button');
        previousButton.type = 'button';
        previousButton.className = 'btn btn-outline-secondary';
        previousButton.innerHTML = '<i class="fas fa-arrow-left me-2"></i>Kembali';
        const nextButton = document.createElement('button');
        nextButton.type = 'button';
        nextButton.className = 'btn btn-outline-primary';
        nextButton.innerHTML = 'Lanjut<i class="fas fa-arrow-right ms-2"></i>';
        navigation.append(previousButton, nextButton);
        const wizardLayout = document.createElement('div');
        wizardLayout.className = 'landing-wizard-layout';
        const sidebar = document.createElement('aside');
        sidebar.className = 'landing-wizard-sidebar';
        const content = document.createElement('div');
        content.className = 'landing-wizard-content';
        sidebar.appendChild(tabs);
        content.append(navigation, ...cards);
        wizardLayout.append(sidebar, content);
        form.prepend(wizardLayout);

        const activateTab = (activeIndex) => {
            cards.forEach((card, index) => {
                card.hidden = index !== activeIndex;
                tabs.children[index]?.classList.toggle('active', index === activeIndex);
                tabs.children[index]?.setAttribute('aria-selected', String(index === activeIndex));
            });
            previousButton.disabled = activeIndex === 0;
            nextButton.disabled = activeIndex === cards.length - 1;
        };

        cards.forEach((card, index) => {
            const heading = card.querySelector('.section-title');
            if (!heading) {
                return;
            }

            const tab = document.createElement('button');
            tab.type = 'button';
            tab.className = 'nav-link';
            tab.innerHTML = `<span class="badge rounded-pill text-bg-light me-1">${index + 1}</span>${heading.querySelector('h5')?.textContent.trim() || `Section ${index + 1}`}`;
            tab.setAttribute('aria-selected', 'false');
            tab.addEventListener('click', () => activateTab(index));
            tabs.appendChild(tab);

            const saveButton = document.createElement('button');
            saveButton.type = 'submit';
            saveButton.className = 'btn btn-primary mt-4';
            saveButton.innerHTML = '<i class="fas fa-check me-2"></i>Simpan section ini';
            card.appendChild(saveButton);
        });

        previousButton.addEventListener('click', () => {
            const activeIndex = cards.findIndex((card) => !card.hidden);
            if (activeIndex > 0) {
                activateTab(activeIndex - 1);
            }
        });
        nextButton.addEventListener('click', () => {
            const activeIndex = cards.findIndex((card) => !card.hidden);
            if (activeIndex < cards.length - 1) {
                activateTab(activeIndex + 1);
            }
        });

        activateTab(0);
    })();
</script>
<script>
    (() => {
        const form = document.querySelector('form[action="{{ route('admin.landing-settings.update') }}"]');
        if (!form) {
            return;
        }

        document.querySelectorAll('input[type="checkbox"][name^="landing_section_"]').forEach((toggle) => {
            const sectionCard = toggle.closest('.content-card');
            const fields = sectionCard?.querySelectorAll('input:not([type="hidden"]):not([type="checkbox"]):not([type="file"]), textarea, select') || [];
            const requiredFields = [...fields].filter((field) => field.required);
            const syncSectionRequiredState = () => requiredFields.forEach((field) => {
                field.required = toggle.checked;
            });

            toggle.addEventListener('change', syncSectionRequiredState);
            syncSectionRequiredState();
        });

        const buttonFieldMap = {
            landing_cta_rsvp_enabled: ['landing_cta_rsvp_label', 'landing_cta_rsvp_url'],
            landing_cta_location_enabled: ['landing_cta_location_label', 'landing_cta_location_url'],
            landing_cta_gallery_rsvp_enabled: ['landing_cta_gallery_rsvp_label', 'landing_cta_gallery_rsvp_url'],
            landing_cta_gallery_location_enabled: ['landing_cta_gallery_location_label', 'landing_cta_gallery_location_url'],
        };
        Object.entries(buttonFieldMap).forEach(([toggleName, fieldNames]) => {
            const toggle = document.querySelector(`input[type="checkbox"][name="${toggleName}"]`);
            const sectionName = toggleName.includes('gallery') ? 'landing_section_cta_gallery' : 'landing_section_cta';
            const sectionToggle = document.querySelector(`input[type="checkbox"][name="${sectionName}"]`);
            const fields = fieldNames.map((name) => form.querySelector(`[name="${name}"]`)).filter(Boolean);
            const requiredFields = fields.filter((field) => field.required);
            const syncButtonRequiredState = () => requiredFields.forEach((field) => {
                field.required = toggle.checked && Boolean(sectionToggle?.checked);
            });

            toggle?.addEventListener('change', syncButtonRequiredState);
            sectionToggle?.addEventListener('change', syncButtonRequiredState);
            syncButtonRequiredState();
        });

        document.querySelectorAll('input[type="checkbox"][id^="landing_bride_"], input[type="checkbox"][id^="landing_groom_"]').forEach((toggle) => {
            if (!toggle.name.endsWith('_enabled')) {
                return;
            }

            const field = form.querySelector(`[name="${toggle.name.replace('_enabled', '_url')}"]`);
            const coupleToggle = form.querySelector('[name="landing_section_couple"]');
            if (!field) {
                return;
            }

            const syncSocialRequiredState = () => {
                field.required = toggle.checked && Boolean(coupleToggle?.checked);
            };
            toggle.addEventListener('change', syncSocialRequiredState);
            coupleToggle?.addEventListener('change', syncSocialRequiredState);
            syncSocialRequiredState();
        });

        document.querySelectorAll('[id^="landing_story_"][id$="_enabled"]').forEach((toggle) => {
            const storyCard = toggle.closest('.border.rounded');
            const fields = storyCard?.querySelectorAll('[data-story-field]') || [];
            const syncRequiredState = () => fields.forEach((field) => {
                field.required = toggle.checked;
            });

            toggle.addEventListener('change', syncRequiredState);
            syncRequiredState();
        });
    })();
</script>
<script>
    (() => {
        const form = document.querySelector('form[action="{{ route('admin.landing-settings.update') }}"]');
        if (!form) {
            return;
        }

        const compressImage = (file) => new Promise((resolve) => {
            if (!file.type.startsWith('image/')) {
                resolve(file);
                return;
            }

            const image = new Image();
            const sourceUrl = URL.createObjectURL(file);
            image.onload = () => {
                const maxDimension = 1600;
                const scale = Math.min(1, maxDimension / Math.max(image.naturalWidth, image.naturalHeight));
                const canvas = document.createElement('canvas');
                canvas.width = Math.max(1, Math.round(image.naturalWidth * scale));
                canvas.height = Math.max(1, Math.round(image.naturalHeight * scale));
                canvas.getContext('2d').drawImage(image, 0, 0, canvas.width, canvas.height);
                canvas.toBlob((blob) => {
                    URL.revokeObjectURL(sourceUrl);
                    if (!blob || blob.size >= file.size) {
                        resolve(file);
                        return;
                    }

                    resolve(new File([blob], file.name.replace(/\.[^.]+$/, '.webp'), {type: 'image/webp', lastModified: Date.now()}));
                }, 'image/webp', 0.72);
            };
            image.onerror = () => {
                URL.revokeObjectURL(sourceUrl);
                resolve(file);
            };
            image.src = sourceUrl;
        });

        const validateFileSize = (input) => {
            const maximumFileSize = Number(input.dataset.maxSize || 2 * 1024 * 1024);
            if (!input.files.length || input.files[0].size <= maximumFileSize) {
                return true;
            }

            const maximumFileSizeInMb = Math.round(maximumFileSize / 1024 / 1024);
            window.alert(`Ukuran file maksimal ${maximumFileSizeInMb} MB. Silakan pilih file yang lebih kecil.`);
            input.value = '';
            return false;
        };
        form.querySelectorAll('input[type="file"]').forEach((input) => input.addEventListener('change', () => validateFileSize(input)));

        form.addEventListener('submit', async (event) => {
            if (form.dataset.uploaded === 'true') {
                return;
            }

            const files = [...form.querySelectorAll('input[type="file"]')].filter((input) => input.files.length);
            if (files.some((input) => !validateFileSize(input))) {
                event.preventDefault();
                return;
            }
            if (!files.length) {
                return;
            }

            event.preventDefault();
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengompres dan mengunggah foto...';
            }

            try {
                for (const input of files) {
                    const compressedFile = await compressImage(input.files[0]);
                    const payload = new FormData();
                    payload.append('_token', form.querySelector('input[name="_token"]').value);
                    payload.append('photo_key', input.name);
                    payload.append('photo', compressedFile);
                    const response = await fetch('{{ route('admin.landing-settings.photo') }}', {
                        method: 'POST',
                        headers: {'Accept': 'application/json'},
                        body: payload,
                    });
                    if (!response.ok) {
                        throw new Error('Upload foto gagal.');
                    }

                    const result = await response.json();
                    const preview = input.parentElement.querySelector('img');
                    if (preview && result.url) {
                        preview.src = result.url;
                    }
                    input.value = '';
                }

                form.dataset.uploaded = 'true';
                HTMLFormElement.prototype.submit.call(form);
            } catch (error) {
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-check me-2"></i>Simpan pengaturan landing page';
                }
                window.alert(error.message || 'Upload foto gagal.');
            }
        });
    })();
</script>
@endsection
