<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Records') — Merenciano</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a237e 0%, #283593 100%);
            width: 240px;
            position: fixed;
            top: 0; left: 0;
            padding-top: 1rem;
            z-index: 100;
        }
        .sidebar .nav-link { color: rgba(255,255,255,.75); padding: .6rem 1.5rem; border-radius: 8px; margin: 2px 10px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.15); }
        .sidebar .brand { color: #fff; font-size: 1.2rem; font-weight: 700; padding: 1rem 1.5rem 1.5rem; display: block; }
        .main-content { margin-left: 240px; padding: 2rem; }
        .stat-card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .toast-container { z-index: 9999; }
    </style>
    @stack('styles')
</head>
<body>

@auth
<div class="sidebar d-flex flex-column">
    <a class="brand" href="{{ route('dashboard') }}">
        <i class="bi bi-mortarboard-fill me-2"></i>StudentRec
    </a>
    <ul class="nav flex-column flex-grow-1">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <i class="bi bi-person-gear me-2"></i>Users Management
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                <i class="bi bi-people-fill me-2"></i>Students
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                <i class="bi bi-box-seam me-2"></i>My Products
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.show') }}">
                <i class="bi bi-person-circle me-2"></i>My Profile
            </a>
        </li>
    </ul>
    <div class="p-3 border-top border-secondary">
        <div class="d-flex align-items-center gap-2 mb-2">
            @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="rounded-circle" width="32" height="32" style="object-fit:cover;">
            @else
            <i class="bi bi-person-circle text-white-50" style="font-size:2rem;"></i>
            @endif
            <div class="text-white small">{{ Auth::user()->name }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm w-100"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
        </form>
    </div>
</div>
<div class="main-content">
@endauth

    @yield('content')

@auth
</div>
@endauth

{{-- Toast Notifications --}}
<div class="toast-container position-fixed top-0 end-0 p-3">
    @if(session('success'))
    <div class="toast align-items-center text-bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.toast').forEach(el => {
        const t = new bootstrap.Toast(el, { delay: 4000 });
        t.show();
    });
</script>
@stack('scripts')
</body>
</html>
