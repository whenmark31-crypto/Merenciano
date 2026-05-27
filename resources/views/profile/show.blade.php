@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">My Profile</h4>
        <small class="text-muted">View your account information</small>
    </div>
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
        <i class="bi bi-pencil-fill me-1"></i>Edit Profile
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body text-center p-4">
                @if(Auth::user()->profile_picture && file_exists(public_path('storage/' . Auth::user()->profile_picture)))
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                     class="rounded-circle mb-3" width="150" height="150" style="object-fit:cover;">
                @else
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:150px;height:150px;">
                    <i class="bi bi-person-fill text-primary" style="font-size:4rem;"></i>
                </div>
                @endif
                <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                <p class="text-muted small mb-0">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle-fill text-primary me-2"></i>Personal Information</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Full Name</label>
                        <p class="fw-semibold mb-0">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Email Address</label>
                        <p class="fw-semibold mb-0">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Gender</label>
                        <p class="fw-semibold mb-0">{{ Auth::user()->gender ?? 'Not specified' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Phone Number</label>
                        <p class="fw-semibold mb-0">{{ Auth::user()->phone ?? 'Not specified' }}</p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small">Address</label>
                        <p class="fw-semibold mb-0">{{ Auth::user()->address ?? 'Not specified' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Member Since</label>
                        <p class="fw-semibold mb-0">{{ Auth::user()->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
