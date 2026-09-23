@extends('layouts.admin')
@section('title', 'Pengaturan Aplikasi')
@section('page-title', 'Pengaturan Aplikasi')
@section('page-subtitle', 'Sesuaikan identitas dan tampilan aplikasi Anda.')
@section('content')
<style>
    .application-settings-section .section-title {
        cursor: pointer;
    }

    .application-section-toggle {
        margin-left: auto;
        border: 0;
        background: #f4f3ff;
        color: #6c63ff;
        border-radius: 8px;
        width: 32px;
        height: 32px;
    }

    .application-settings-tabs .nav-link {
        width: 100%;
        text-align: left;
        color: #6c63ff;
        background: #f4f3ff;
        border: 0;
        border-radius: 8px;
    }

    .application-settings-tabs .nav-link.active {
        color: #fff;
        background: #6c63ff;
    }

    .application-wizard-navigation {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 1rem;
    }

    .application-wizard-layout {
        display: grid;
        grid-template-columns: 280px minmax(0, 1fr);
        gap: 28px;
        align-items: start;
    }

    .application-wizard-sidebar {
        position: sticky;
        top: 20px;
        padding: 18px;
        background: #fff;
        border: 1px solid #e9e7f5;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(35, 31, 77, .06);
    }

    .application-wizard-sidebar::before {
        display: block;
        margin-bottom: 14px;
        color: #25213f;
        content: 'Langkah pengaturan';
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .application-wizard-content > .col-12 > .content-card {
        border: 1px solid #e9e7f5;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(35, 31, 77, .06);
        padding: 24px;
    }

    .application-settings-tabs .nav-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px 13px;
        font-weight: 600;
        transition: .2s ease;
    }

    .application-settings-tabs .nav-link:hover {
        transform: translateX(3px);
    }

    .application-settings-tabs .nav-link.active .badge {
        color: #6c63ff !important;
        background: #fff !important;
    }

    .application-wizard-content .section-title {
        margin-bottom: 24px;
    }

    [data-bs-theme="dark"] .application-wizard-sidebar,
    [data-bs-theme="dark"] .application-wizard-content > .col-12 > .content-card {
        background: #1f2430;
        border-color: #3b4354;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
    }

    [data-bs-theme="dark"] .application-wizard-sidebar::before,
    [data-bs-theme="dark"] .application-wizard-content .section-title h5 {
        color: #f1f3f8;
    }

    [data-bs-theme="dark"] .application-settings-tabs .nav-link {
        color: #c9c5ff;
        background: #2b3241;
    }

    [data-bs-theme="dark"] .application-settings-tabs .nav-link.active {
        color: #fff;
        background: #6c63ff;
    }

    [data-bs-theme="dark"] .application-settings-tabs .nav-link.active .badge {
        color: #6c63ff !important;
    }

    @media (max-width: 991px) {
        .application-wizard-layout {
            grid-template-columns: 1fr;
        }

        .application-wizard-sidebar {
            position: static;
            padding: 14px;
        }

        .application-settings-tabs {
            flex-direction: row !important;
        }

        .application-settings-tabs .nav-link {
            width: auto;
        }
    }
</style>
<div class="settings-shell">
    @if (session('success'))<div class="alert alert-success small">{{ session('success') }}</div>@endif
    @if ($errors->any())<div class="alert alert-danger small">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('admin.settings.update') }}">@csrf @method('PUT')
        <div class="row g-4">
            <div class="col-12"><div class="content-card"><div class="section-title"><span class="section-number">01</span><div><h5>Identitas aplikasi</h5><p>Nama dan informasi dasar yang tampil di seluruh halaman.</p></div></div><div class="row g-3"><div class="col-md-6"><label class="form-label">Nama aplikasi</label><input name="app_name" class="form-control" value="{{ old('app_name', $settings['app_name'] ?? '') }}" required></div><div class="col-md-6"><label class="form-label">Versi aplikasi</label><input name="app_version" class="form-control" value="{{ old('app_version', $settings['app_version'] ?? '') }}" required></div><div class="col-md-6"><label class="form-label">Tagline</label><input name="app_tagline" class="form-control" value="{{ old('app_tagline', $settings['app_tagline'] ?? '') }}"></div><div class="col-md-6"><label class="form-label">Teks footer</label><input name="footer_text" class="form-control" value="{{ old('footer_text', $settings['footer_text'] ?? '') }}" required></div></div></div></div>
            <div class="col-12"><div class="content-card"><div class="section-title"><span class="section-number">02</span><div><h5>Tampilan & warna</h5><p>Semua pengaturan visual aplikasi dikelola dari satu bagian.</p></div></div><div class="row g-3"><div class="col-md-3"><div class="layout-color-card"><div class="swatch-preview" id="primary-preview"></div><label class="form-label">Warna utama</label><div class="color-control"><input type="color" id="primary-picker" value="{{ old('primary_color', $settings['primary_color'] ?? '#6c63ff') }}"><input name="primary_color" id="primary-color" class="form-control" value="{{ old('primary_color', $settings['primary_color'] ?? '#6c63ff') }}" pattern="^#[0-9A-Fa-f]{6}$" required></div></div></div><div class="col-md-3"><div class="layout-color-card"><div class="swatch-preview" id="sidebar-preview"></div><label class="form-label">Sidebar</label><div class="color-control"><input type="color" id="sidebar-picker" value="{{ old('sidebar_color', $settings['sidebar_color'] ?? '#1f2440') }}"><input name="sidebar_color" id="sidebar-color" class="form-control" value="{{ old('sidebar_color', $settings['sidebar_color'] ?? '#1f2440') }}" pattern="^#[0-9A-Fa-f]{6}$" required></div></div></div><div class="col-md-3"><div class="layout-color-card"><div class="swatch-preview" id="navbar-preview"></div><label class="form-label">Navbar</label><div class="color-control"><input type="color" id="navbar-picker" value="{{ old('navbar_color', $settings['navbar_color'] ?? '#ffffff') }}"><input name="navbar_color" id="navbar-color" class="form-control" value="{{ old('navbar_color', $settings['navbar_color'] ?? '#ffffff') }}" pattern="^#[0-9A-Fa-f]{6}$" required></div></div></div><div class="col-md-3"><div class="layout-color-card"><div class="swatch-preview" id="footer-preview"></div><label class="form-label">Footer</label><div class="color-control"><input type="color" id="footer-picker" value="{{ old('footer_color', $settings['footer_color'] ?? '#ffffff') }}"><input name="footer_color" id="footer-color" class="form-control" value="{{ old('footer_color', $settings['footer_color'] ?? '#ffffff') }}" pattern="^#[0-9A-Fa-f]{6}$" required></div></div></div><div class="col-md-4"><label class="form-label">Tema default</label><select name="default_theme" class="form-select"><option value="light" @selected(($settings['default_theme'] ?? 'light') === 'light')>Light mode</option><option value="dark" @selected(($settings['default_theme'] ?? 'light') === 'dark')>Dark mode</option></select></div></div></div></div>
            <div class="col-12"><div class="content-card"><div class="section-title"><span class="section-number">03</span><div><h5>Kontak & regional</h5><p>Informasi pendukung untuk kebutuhan sistem.</p></div></div><div class="row g-3"><div class="col-md-6"><label class="form-label">Email kontak</label><input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"></div><div class="col-md-6"><label class="form-label">Timezone</label><select name="timezone" class="form-select"><option value="Asia/Makassar" @selected(($settings['timezone'] ?? '') === 'Asia/Makassar')>Asia/Makassar (WITA)</option><option value="Asia/Jakarta" @selected(($settings['timezone'] ?? '') === 'Asia/Jakarta')>Asia/Jakarta (WIB)</option><option value="Asia/Jayapura" @selected(($settings['timezone'] ?? '') === 'Asia/Jayapura')>Asia/Jayapura (WIT)</option><option value="UTC" @selected(($settings['timezone'] ?? '') === 'UTC')>UTC</option></select></div></div></div></div>
            <div class="col-12"><div class="content-card google-settings-card"><div class="section-title"><span class="section-number"><i class="fab fa-google"></i></span><div><h5>Google OAuth & API</h5><p>Atur kredensial untuk login dan registrasi dengan akun Google.</p></div></div><div class="alert alert-info small"><i class="fas fa-circle-info me-2"></i>Tambahkan redirect URI berikut di Google Cloud Console: <code>{{ route('auth.google.callback') }}</code></div><div class="row g-3"><div class="col-md-6"><label class="form-label">Google Client ID</label><input name="google_client_id" class="form-control" value="{{ old('google_client_id', $settings['google_client_id'] ?? '') }}" placeholder="xxxx.apps.googleusercontent.com"></div><div class="col-md-6"><label class="form-label">Google Client Secret</label><input type="password" name="google_client_secret" class="form-control" value="{{ old('google_client_secret', $settings['google_client_secret'] ?? '') }}" placeholder="Kosongkan jika tidak diubah"></div><div class="col-md-6"><label class="form-label">Google API Key <span class="text-muted">(opsional)</span></label><input type="password" name="google_api_key" class="form-control" value="{{ old('google_api_key', $settings['google_api_key'] ?? '') }}" placeholder="AIza..."></div><div class="col-md-6"><label class="form-label">Redirect URI <span class="text-muted">(opsional)</span></label><input type="url" name="google_redirect_uri" class="form-control" value="{{ old('google_redirect_uri', $settings['google_redirect_uri'] ?? route('auth.google.callback')) }}"></div></div></div></div>
            <div class="col-12 d-flex justify-content-end"><button class="btn btn-primary px-4"><i class="fas fa-check me-2"></i>Simpan pengaturan</button></div>
        </div>
    </form>
</div>
<script>
    (() => {
        const form = document.querySelector('form[action="{{ route('admin.settings.update') }}"]');
        const cards = [...(form?.querySelectorAll('.content-card') || [])];
        if (!form || !cards.length) {
            return;
        }

        const tabs = document.createElement('div');
        tabs.className = 'application-settings-tabs nav nav-pills flex-column gap-2';

        const navigation = document.createElement('div');
        navigation.className = 'application-wizard-navigation';
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
        wizardLayout.className = 'application-wizard-layout';
        const sidebar = document.createElement('aside');
        sidebar.className = 'application-wizard-sidebar';
        const content = document.createElement('div');
        content.className = 'application-wizard-content';
        sidebar.appendChild(tabs);
        content.append(navigation);
        cards.forEach((card) => content.appendChild(card.closest('.col-12')));
        wizardLayout.append(sidebar, content);
        form.prepend(wizardLayout);

        const activateTab = (activeIndex) => {
            cards.forEach((card, index) => {
                card.closest('.col-12').hidden = index !== activeIndex;
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
            const activeIndex = cards.findIndex((card) => !card.closest('.col-12').hidden);
            if (activeIndex > 0) {
                activateTab(activeIndex - 1);
            }
        });
        nextButton.addEventListener('click', () => {
            const activeIndex = cards.findIndex((card) => !card.closest('.col-12').hidden);
            if (activeIndex < cards.length - 1) {
                activateTab(activeIndex + 1);
            }
        });

        activateTab(0);
    })();

    const bindColor = (picker, input, preview) => {
        const pickerElement = document.getElementById(picker);
        const inputElement = document.getElementById(input);
        const previewElement = document.getElementById(preview);
        const paint = (color) => {
            if (previewElement) {
                previewElement.style.backgroundColor = color;
            }
        };
        const sync = () => {
            if (/^#[0-9a-f]{6}$/i.test(inputElement.value)) {
                pickerElement.value = inputElement.value;
                paint(inputElement.value);
            }
        };
        pickerElement?.addEventListener('input', () => {
            inputElement.value = pickerElement.value;
            paint(pickerElement.value);
        });
        inputElement?.addEventListener('input', sync);
        sync();
    };
    bindColor('primary-picker', 'primary-color', 'primary-preview');
    bindColor('sidebar-picker', 'sidebar-color', 'sidebar-preview');
    bindColor('navbar-picker', 'navbar-color', 'navbar-preview');
    bindColor('footer-picker', 'footer-color', 'footer-preview');
</script>
@endsection
