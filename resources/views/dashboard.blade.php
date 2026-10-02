@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Pantau konfirmasi kehadiran tamu undangan.')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-xl-4 mb-4">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-label">Total Tamu Undangan</p>
                        <h2>{{ $guestCount }}</h2>
                    </div>
                    <div class="stat-icon icon-primary">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mb-4">
            <a href="{{ route('dashboard', ['rsvp' => 'attending']) }}" class="stat-card h-100 d-block text-decoration-none {{ $selectedRsvpStatus === 'attending' ? 'border-primary' : '' }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div><p class="stat-label">Hadir</p><h2 class="text-success">{{ $attendingGuestCount }}</h2></div>
                    <div class="stat-icon icon-success"><i class="fas fa-user-check"></i></div>
                </div>
                <div class="stat-foot text-muted"><i class="fas fa-arrow-pointer"></i><span>Klik untuk melihat daftar</span></div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mb-4">
            <a href="{{ route('dashboard', ['rsvp' => 'declined']) }}" class="stat-card h-100 d-block text-decoration-none {{ $selectedRsvpStatus === 'declined' ? 'border-danger' : '' }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div><p class="stat-label">Tidak hadir</p><h2 class="text-danger">{{ $declinedGuestCount }}</h2></div>
                    <div class="stat-icon icon-danger"><i class="fas fa-user-xmark"></i></div>
                </div>
                <div class="stat-foot text-muted"><i class="fas fa-arrow-pointer"></i><span>Klik untuk melihat daftar</span></div>
            </a>
        </div>
    </div>

    @if ($selectedRsvpStatus !== null)
        <div class="content-card">
            <div class="card-heading">
                <div>
                    <h5>Daftar tamu {{ $selectedRsvpStatus === 'attending' ? 'yang hadir' : 'yang tidak hadir' }}</h5>
                    <p>{{ $selectedGuests->count() }} tamu telah memberikan konfirmasi.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-light">Tampilkan semua</a>
            </div>
            <div class="table-responsive"><table class="table align-middle"><thead><tr><th>NAMA</th><th>NO. TELEPON</th><th>STATUS</th></tr></thead><tbody>
                @forelse ($selectedGuests as $guest)
                    <tr><td><strong>{{ $guest->name }}</strong></td><td>{{ $guest->phone ?: '-' }}</td><td><span class="status {{ $selectedRsvpStatus === 'attending' ? 'status-success' : 'status-warning' }}">{{ $selectedRsvpStatus === 'attending' ? 'Hadir' : 'Tidak hadir' }}</span></td></tr>
                @empty
                    <tr><td colspan="3" class="text-center text-muted py-4">Belum ada tamu dengan status ini.</td></tr>
                @endforelse
            </tbody></table></div>
        </div>
    @endif
@endsection
