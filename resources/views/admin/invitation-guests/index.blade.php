@extends('layouts.admin')
@section('title', 'Tamu Undangan')
@section('page-title', 'Tamu Undangan')
@section('page-subtitle', 'Kelola nama tamu, link undangan unik, dan pesan WhatsApp.')
@section('content')
<div class="content-card mb-4">
    <div class="card-heading"><div><h5>Format pesan WhatsApp</h5><p>Atur pesan yang digunakan untuk setiap tamu undangan.</p></div></div>
    <form method="POST" action="{{ route('admin.landing-settings.update') }}" class="row g-3">
        @csrf @method('PUT')
        <input type="hidden" name="save_section" value="guest_message">
        <div class="col-12"><label class="form-label">Format pesan WhatsApp</label><textarea name="landing_guest_message_template" class="form-control" rows="4" required>{{ old('landing_guest_message_template', $guestSettings['landing_guest_message_template']) }}</textarea><div class="form-text">Gunakan <code>@{{nama}}</code> untuk nama tamu dan <code>@{{link}}</code> untuk link unik. Link akan dikirim sebagai URL yang dapat diklik di WhatsApp.</div></div>
        <div class="col-12 d-flex justify-content-end"><button class="btn btn-primary"><i class="fas fa-save me-1"></i>Simpan pengaturan</button></div>
    </form>
</div>
<div class="content-card">
    @if (session('success'))<div class="alert alert-success small">{{ session('success') }}</div>@endif
    @if ($errors->any())<div class="alert alert-danger small">{{ $errors->first() }}</div>@endif
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-8"><input name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari nama tamu..."></div>
        <div class="col-md-4 d-flex gap-2"><button class="btn btn-light flex-grow-1">Cari</button><a href="{{ route('admin.invitation-guests.create') }}" class="btn btn-primary text-nowrap"><i class="fas fa-plus me-1"></i>Tambah</a></div>
    </form>
    <div class="card-heading"><div><h5>Daftar nama undangan</h5><p>{{ $guests->count() }} tamu terdaftar.</p></div></div>
    <div class="table-responsive"><table class="table align-middle"><thead><tr><th>NAMA</th><th>LINK UNDANGAN</th><th>STATUS</th><th>AKSI</th></tr></thead><tbody>
        @forelse ($guests as $guest)
            <tr>
                <td><strong>{{ $guest->name }}</strong>@if($guest->phone)<small class="d-block text-muted">{{ $guest->phone }}</small>@endif</td>
                <td><a href="{{ $guest->invitation_url }}" target="_blank" rel="noopener" class="small text-break">{{ $guest->invitation_url }}</a></td>
                <td><span class="status {{ $guest->is_active ? 'status-success' : 'status-warning' }}">{{ $guest->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                <td><div class="d-flex gap-2 flex-wrap">
                    <button type="button" class="btn btn-sm btn-light" data-copy-message="{{ $guest->invitation_message }}" title="Salin pesan WhatsApp"><i class="fas fa-copy"></i></button>
                    @if($guest->phone)<a href="https://wa.me/{{ preg_replace('/\D+/', '', preg_replace('/^0/', '62', $guest->phone)) }}?text={{ rawurlencode($guest->invitation_message) }}" target="_blank" rel="noopener" class="btn btn-sm btn-success" title="Buka WhatsApp"><i class="fab fa-whatsapp"></i></a>@endif
                    <a href="{{ route('admin.invitation-guests.edit', $guest) }}" class="btn btn-sm btn-light" title="Edit"><i class="fas fa-pen"></i></a>
                    <form method="POST" action="{{ route('admin.invitation-guests.destroy', $guest) }}" data-confirm="Hapus tamu ini? Link undangannya tidak dapat dipakai lagi.">@csrf @method('DELETE')<button class="btn btn-sm btn-light text-danger" title="Hapus"><i class="fas fa-trash"></i></button></form>
                </div></td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted py-4">Belum ada nama tamu undangan.</td></tr>
        @endforelse
    </tbody></table></div>
</div>
<script>
document.querySelectorAll('[data-copy-message]').forEach((button) => button.addEventListener('click', async () => {
    await navigator.clipboard.writeText(button.dataset.copyMessage);
    const icon = button.querySelector('i');
    icon.className = 'fas fa-check text-success';
    setTimeout(() => { icon.className = 'fas fa-copy'; }, 1500);
}));
</script>
@endsection
