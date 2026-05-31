<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Records') — Merenciano</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --bg-card: #ffffff;
            --text-primary: #1a1a1a;
            --text-secondary: #6c757d;
            --border-color: #e9ecef;
            --nav-bg: #ffffff;
            --nav-shadow: 0 2px 20px rgba(0,0,0,.08);
            --accent-primary: #6366f1;
            --accent-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-shadow: 0 4px 20px rgba(0,0,0,.06);
            --hover-bg: #f8f9fa;
        }
        
        [data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --nav-bg: #1e293b;
            --nav-shadow: 0 2px 20px rgba(0,0,0,.4);
            --accent-primary: #818cf8;
            --accent-gradient: linear-gradient(135deg, #818cf8 0%, #a78bfa 100%);
            --card-shadow: 0 4px 20px rgba(0,0,0,.3);
            --hover-bg: #334155;
        }
        
        * { transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-primary);
            color: var(--text-primary);
            padding-top: 70px;
        }
        
        /* Top Navigation */
        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: var(--nav-bg);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--nav-shadow);
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        
        .nav-container {
            max-width: 100%;
            height: 100%;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }
        
        .brand-logo i { 
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .nav-menu {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .nav-menu .nav-link {
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }
        
        .nav-menu .nav-link:hover {
            background: var(--hover-bg);
            color: var(--text-primary);
        }
        
        .nav-menu .nav-link.active {
            background: var(--accent-gradient);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            background: var(--hover-bg);
            color: var(--text-primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.2s;
        }
        
        .theme-toggle:hover {
            background: var(--accent-gradient);
            color: white;
            transform: rotate(20deg);
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            background: var(--hover-bg);
            cursor: pointer;
            position: relative;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid var(--accent-primary);
        }
        
        .user-avatar-placeholder {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--accent-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
            line-height: 1.2;
        }
        
        .user-role {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: none;
            background: var(--hover-bg);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 1.3rem;
            cursor: pointer;
        }
        
        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        /* Cards */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            color: var(--text-primary);
        }
        
        .stat-card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: relative;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent-gradient);
        }
        
        /* Tables */
        .table {
            color: var(--text-primary);
        }
        
        .table-dark {
            background: var(--bg-secondary);
            color: var(--text-primary);
        }
        
        .table-hover tbody tr:hover {
            background: var(--hover-bg);
        }
        
        /* Forms */
        .form-control, .form-select {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 10px;
        }
        
        .form-control:focus, .form-select:focus {
            background: var(--bg-card);
            border-color: var(--accent-primary);
            color: var(--text-primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .form-label {
            color: var(--text-primary);
            font-weight: 500;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--accent-gradient);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        
        /* Toast */
        .toast-container { z-index: 9999; }
        
        /* Responsive */
        @media (max-width: 991px) {
            .nav-menu {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 280px;
                height: calc(100vh - 70px);
                background: var(--nav-bg);
                flex-direction: column;
                padding: 1rem;
                box-shadow: 2px 0 20px rgba(0,0,0,.1);
                transition: left 0.3s;
                align-items: stretch;
            }
            
            .nav-menu.active {
                left: 0;
            }
            
            .nav-menu .nav-link {
                width: 100%;
                justify-content: flex-start;
            }
            
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .user-info {
                display: none;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .nav-container {
                padding: 0 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .brand-logo {
                font-size: 1.2rem;
            }
            
            .brand-logo span {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

@auth
<nav class="top-nav">
    <div class="nav-container">
        <a href="{{ route('dashboard') }}" class="brand-logo">
            <i class="bi bi-mortarboard-fill"></i>
            <span>StudentRec</span>
        </a>
        
        <ul class="nav-menu" id="navMenu">
            <li>
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <i class="bi bi-person-gear"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Students</span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                    <i class="bi bi-box-seam"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.show') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="d-lg-none">
                <form method="POST" action="{{ route('logout') }}" class="w-100">
                    @csrf
                    <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
        
        <div class="nav-actions">
            <button class="theme-toggle" id="themeToggle" title="Toggle theme">
                <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
            </button>
            
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="bi bi-list"></i>
            </button>
            
            <div class="user-menu dropdown d-none d-lg-flex">
                @if(Auth::user()->profile_picture)
                    @if(str_contains(Auth::user()->profile_picture, 'cloudinary') || str_contains(Auth::user()->profile_picture, 'http'))
                        <img src="{{ Auth::user()->profile_picture }}" class="user-avatar" alt="Profile">
                    @elseif(file_exists(public_path('storage/' . Auth::user()->profile_picture)))
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="user-avatar" alt="Profile">
                    @else
                        <div class="user-avatar-placeholder">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                @else
                <div class="user-avatar-placeholder">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                @endif
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
                <i class="bi bi-chevron-down" style="color: var(--text-secondary);"></i>
                
                <div class="dropdown-menu dropdown-menu-end" style="margin-top: 0.5rem;">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        <i class="bi bi-person me-2"></i>My Profile
                    </a>
                    <hr class="dropdown-divider">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

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
// Theme Toggle
const themeToggle = document.getElementById('themeToggle');
const themeIcon = document.getElementById('themeIcon');
const html = document.documentElement;

// Load saved theme
const savedTheme = localStorage.getItem('theme') || 'light';
html.setAttribute('data-theme', savedTheme);
updateThemeIcon(savedTheme);

themeToggle?.addEventListener('click', () => {
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcon(newTheme);
});

function updateThemeIcon(theme) {
    if (themeIcon) {
        themeIcon.className = theme === 'light' ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
    }
}

// Mobile Menu Toggle
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const navMenu = document.getElementById('navMenu');

mobileMenuToggle?.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    const icon = mobileMenuToggle.querySelector('i');
    icon.className = navMenu.classList.contains('active') ? 'bi bi-x-lg' : 'bi bi-list';
});

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
    if (!navMenu?.contains(e.target) && !mobileMenuToggle?.contains(e.target)) {
        navMenu?.classList.remove('active');
        const icon = mobileMenuToggle?.querySelector('i');
        if (icon) icon.className = 'bi bi-list';
    }
});

// Toast notifications
document.querySelectorAll('.toast').forEach(el => {
    const t = new bootstrap.Toast(el, { delay: 4000 });
    t.show();
});

// Dropdown menu
const userMenu = document.querySelector('.user-menu');
const dropdownMenu = userMenu?.querySelector('.dropdown-menu');

userMenu?.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdownMenu?.classList.toggle('show');
});

document.addEventListener('click', () => {
    dropdownMenu?.classList.remove('show');
});
</script>
@stack('scripts')
</body>
</html>
