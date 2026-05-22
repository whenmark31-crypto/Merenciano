@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<div class="mb-4">
    <a href="{{ route('users.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i>Back to Users
    </a>
    <h4 class="fw-bold mt-1 mb-0">Edit User — <span class="text-primary">{{ $user->name }}</span></h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;max-width:800px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf @method('PUT')
            @include('users._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-check-lg me-1"></i>Update User
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
