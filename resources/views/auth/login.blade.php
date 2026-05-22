@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg,#1a237e,#283593);">
    <div class="card shadow-lg border-0" style="width:100%;max-width:420px;border-radius:16px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <i class="bi bi-mortarboard-fill text-primary" style="font-size:2.5rem;"></i>
                <h4 class="fw-bold mt-2">Welcome Back</h4>
                <p class="text-muted small">Student Records System</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger py-2">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Your password" required>
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label small" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                </button>
            </form>
            <p class="text-center mt-3 mb-0 small">No account yet? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
</div>
@endsection
