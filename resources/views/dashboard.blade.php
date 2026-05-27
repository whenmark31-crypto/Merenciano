@extends('layouts.app')
@section('title', 'Dashboard')

@push('styles')
<style>
    .page-header {
        margin-bottom: 2rem;
    }
    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }
    .page-subtitle {
        color: var(--text-secondary);
        font-size: 0.95rem;
    }
    .stat-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        background: var(--bg-card);
        transition: all 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .stat-card.primary::before { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stat-card.success::before { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .stat-card.warning::before { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .stat-card.info::before { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1;
    }
    .stat-label {
        color: var(--text-secondary);
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }
    .chart-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.25rem;
        height: 100%;
    }
    .chart-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .chart-container {
        position: relative;
        height: 280px;
    }
</style>
@endpush

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ Auth::user()->name }}! Here's your overview.</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Add Student
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    @foreach([
        ['Total Users', $totalUsers, 'bi-people-fill', 'primary', 'rgba(102, 126, 234, 0.1)'],
        ['Total Students', $totalStudents, 'bi-mortarboard-fill', 'success', 'rgba(17, 153, 142, 0.1)'],
        ['My Products', $totalProducts, 'bi-box-seam', 'warning', 'rgba(240, 147, 251, 0.1)'],
        ['Graduated', $graduated, 'bi-award-fill', 'info', 'rgba(79, 172, 254, 0.1)'],
    ] as [$label, $val, $icon, $color, $bg])
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card {{ $color }} h-100">
            <div class="card-body d-flex align-items-center gap-3 p-3">
                <div class="stat-icon" style="background: {{ $bg }};">
                    <i class="bi {{ $icon }}" style="background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="stat-value">{{ $val }}</div>
                    <div class="stat-label">{{ $label }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div class="row g-3">
    <div class="col-lg-7">
        <div class="chart-card">
            <h6 class="chart-title">
                <i class="bi bi-bar-chart-fill" style="color: var(--accent-primary);"></i>
                Students by Course
            </h6>
            <div class="chart-container">
                <canvas id="courseChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="chart-card">
            <h6 class="chart-title">
                <i class="bi bi-pie-chart-fill" style="color: var(--accent-primary);"></i>
                Students by Year Level
            </h6>
            <div class="chart-container">
                <canvas id="yearChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
const courseLabels = @json($byCourse->keys());
const courseData = @json($byCourse->values());
const yearLabels = @json($byYear->keys()->map(fn($y) => 'Year ' . $y));
const yearData = @json($byYear->values());

const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
const textColor = isDark ? '#f1f5f9' : '#1a1a1a';
const gridColor = isDark ? '#334155' : '#e9ecef';

Chart.defaults.color = textColor;
Chart.defaults.borderColor = gridColor;

new Chart(document.getElementById('courseChart'), {
    type: 'bar',
    data: {
        labels: courseLabels,
        datasets: [{
            label: 'Students',
            data: courseData,
            backgroundColor: 'rgba(102, 126, 234, 0.8)',
            borderRadius: 8,
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: isDark ? '#1e293b' : '#ffffff',
                titleColor: textColor,
                bodyColor: textColor,
                borderColor: gridColor,
                borderWidth: 1,
                padding: 12,
                cornerRadius: 8
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 },
                grid: { color: gridColor }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});

new Chart(document.getElementById('yearChart'), {
    type: 'doughnut',
    data: {
        labels: yearLabels,
        datasets: [{
            data: yearData,
            backgroundColor: [
                'rgba(102, 126, 234, 0.8)',
                'rgba(118, 75, 162, 0.8)',
                'rgba(79, 172, 254, 0.8)',
                'rgba(17, 153, 142, 0.8)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 10,
                    usePointStyle: true,
                    pointStyle: 'circle',
                    font: { size: 11 }
                }
            },
            tooltip: {
                backgroundColor: isDark ? '#1e293b' : '#ffffff',
                titleColor: textColor,
                bodyColor: textColor,
                borderColor: gridColor,
                borderWidth: 1,
                padding: 12,
                cornerRadius: 8
            }
        }
    }
});

// Update charts on theme change
const observer = new MutationObserver(() => {
    location.reload();
});
observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });
</script>
@endpush
