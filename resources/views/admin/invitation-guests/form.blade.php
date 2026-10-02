@extends('layouts.admin')
@section('title', $pageTitle)
@section('page-title', $pageTitle)
@section('page-subtitle', 'Nama tamu akan tampil pada Hero dan digunakan dalam pesan WhatsApp.')
@section('content')
<div class="content-card"><form method="POST" action="{{ $guest->exists ? route('admin.invitation-guests.update', $guest) : route('admin.invitation-guests.store') }}" class="row g-3">
    @csrf @if($guest->exists) @method('PUT') @endif
    @if($errors->any())<div class="col-12"><div class="alert alert-danger small">{{ $errors->first() }}</div></div>@endif
    <div class="col-md-8"><label class="form-label">Nama tamu</label><input name="name" class="form-control" value="{{ old('name', $guest->name) }}" required maxlength="150" autofocus></div>
    <div class="col-md-4"><label class="form-label">Nomor WhatsApp <span class="text-muted">(opsional)</span></label><input name="phone" class="form-control" value="{{ old('phone', $guest->phone) }}" placeholder="08xxxxxxxxxx" maxlength="30"></div>
    <div class="col-12"><input type="hidden" name="is_active" value="0"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" @checked(old('is_active', $guest->is_active ?? true))><label class="form-check-label" for="is_active">Link undangan aktif</label></div></div>
    @if($guest->exists)<div class="col-12"><div class="alert alert-light small mb-0">Link unik: <a href="{{ route('invitation', $guest) }}" target="_blank" rel="noopener">{{ route('invitation', $guest) }}</a></div></div>@endif
    <div class="col-12 d-flex justify-content-end gap-2"><a href="{{ route('admin.invitation-guests.index') }}" class="btn btn-light">Batal</a><button class="btn btn-primary">Simpan tamu</button></div>
</form></div>
@endsection
