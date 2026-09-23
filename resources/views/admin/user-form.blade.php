@extends('layouts.admin')
@section('title', $pageTitle)
@section('page-title', $pageTitle)
@section('page-subtitle', 'Kelola identitas dan role pengguna.')
@section('content')
@php($currentRoleId = old('role_id', $user->role_id ?: $roles->firstWhere('slug', $user->role ?: 'user')?->id))
<div class="content-card"><form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" class="row g-3">
    @csrf @if($user->exists) @method('PUT') @endif
    @if($errors->any())<div class="col-12"><div class="alert alert-danger small">{{ $errors->first() }}</div></div>@endif
    <div class="col-md-6"><label class="form-label">Nama lengkap</label><input name="name" class="form-control" value="{{ old('name', $user->name) }}" required></div>
    <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required></div>
    <div class="col-md-6"><label class="form-label">Role</label><select name="role_id" class="form-select" required>@foreach($roles as $role)<option value="{{ $role->id }}" @selected((string) $currentRoleId === (string) $role->id)>{{ $role->name }} — {{ $role->description }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label">Password {{ $user->exists ? '(opsional)' : '' }}</label><input type="password" name="password" class="form-control" minlength="8" {{ $user->exists ? '' : 'required' }}></div>
    <div class="col-md-6"><label class="form-label">Konfirmasi password</label><input type="password" name="password_confirmation" class="form-control" minlength="8" {{ $user->exists ? '' : 'required' }}></div>
    <div class="col-12 d-flex justify-content-end gap-2"><a href="{{ route('admin.users') }}" class="btn btn-light">Batal</a><button class="btn btn-primary">Simpan pengguna</button></div>
</form></div>
@endsection
