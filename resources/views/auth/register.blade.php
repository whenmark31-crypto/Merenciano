@extends('layouts.app')
@section('title', 'Register')

@push('styles')
<style>
    body { padding-top: 0; }
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--accent-gradient);
        position: relative;
        overflow: hidden;
    }
    .auth-container::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        top: -200px;
        right: -200px;
    }
    .auth-container::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        bottom: -150px;
        left: -150px;
    }
    .auth-card {
        background: var(--bg-card);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        width: 100%;
        max-width: 480px;
        padding: 3rem;
        position: relative;
        z-index: 1;
    }
    .auth-logo {
        width: 70px;
        height: 70px;
        background: var(--accent-gradient);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
    }
    .auth-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    .auth-subtitle {
        color: var(--text-secondary);
        margin-bottom: 2rem;
    }
    .form-floating > label {
        color: var(--text-secondary);
    }
    .form-floating > .form-control {
        border-radius: 12px;
        border: 2px solid var(--border-color);
        padding: 1rem 1rem;
        height: 58px;
    }
    .form-floating > .form-control:focus {
        border-color: var(--accent-primary);
    }
    .btn-auth {
        height: 54px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        background: var(--accent-gradient);
        border: none;
        color: white;
        transition: all 0.3s;
    }
    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }
    .theme-toggle-auth {
        position: absolute;
        top: 2rem;
        right: 2rem;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        border: none;
        color: white;
        font-size: 1.3rem;
        cursor: pointer;
        backdrop-filter: blur(10px);
        transition: all 0.3s;
    }
    .theme-toggle-auth:hover {
        background: rgba(255,255,255,0.3);
        transform: rotate(20deg);
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <button class="theme-toggle-auth" onclick="document.getElementById('themeToggle')?.click()">
        <i class="bi bi-moon-stars-fill" id="authThemeIcon"></i>
    </button>
    
    <div class="auth-card">
        <div class="auth-logo">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        <h2 class="auth-title text-center">Create Account</h2>
        <p class="auth-subtitle text-center">Join StudentRec Management System</p>

        @if($errors->any())
        <div class="alert alert-danger rounded-3 py-2">
            <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       id="name" value="{{ old('name') }}" placeholder="Full Name" required>
                <label for="name"><i class="bi bi-person me-2"></i>Full Name</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" value="{{ old('email') }}" placeholder="Email" required>
                <label for="email"><i class="bi bi-envelope me-2"></i>Email Address</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" placeholder="Password" required>
                <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
            </div>
            
            <div class="form-floating mb-4">
                <input type="password" name="password_confirmation" class="form-control"
                       id="password_confirmation" placeholder="Confirm Password" required>
                <label for="password_confirmation"><i class="bi bi-lock-fill me-2"></i>Confirm Password</label>
            </div>
            
            <button type="submit" class="btn btn-auth w-100 mb-3">
                <i class="bi bi-person-check me-2"></i>Create Account
            </button>
        </form>
        
        <p class="text-center mb-0" style="color: var(--text-secondary);">
            Already have an account? <a href="{{ route('login') }}" style="color: var(--accent-primary); font-weight: 600;">Sign In</a>
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
const authThemeIcon = document.getElementById('authThemeIcon');
const observer = new MutationObserver(() => {
    const theme = document.documentElement.getAttribute('data-theme');
    if (authThemeIcon) {
        authThemeIcon.className = theme === 'light' ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
    }
});
observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });
</script>
@endpush
