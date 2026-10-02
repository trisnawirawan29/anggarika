@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card">
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
    </div>
@endsection
