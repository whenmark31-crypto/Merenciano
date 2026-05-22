@extends('layouts.app')
@section('title', 'Dashboard')

@push('styles')
<style>
    .stat-card .icon { width: 52px; height: 52px; border-radius: 12px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Dashboard</h4>
        <small class="text-muted">Overview of student records</small>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add Student
    </a>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    @foreach([
        ['Total Users',    $totalUsers,    'bi-people-fill',       'primary', '#e3f2fd'],
        ['Total Students', $totalStudents, 'bi-mortarboard-fill',  'success', '#e8f5e9'],
        ['My Products',    $totalProducts, 'bi-box-seam',          'warning', '#fff8e1'],
        ['Graduated',      $graduated,     'bi-award-fill',        'info',    '#e0f7fa'],
    ] as [$label, $val, $icon, $color, $bg])
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon bg-{{ $color }} bg-opacity-10 text-{{ $color }}">
                    <i class="bi {{ $icon }}"></i>
                </div>
                <div>
                    <div class="fs-3 fw-bold">{{ $val }}</div>
                    <div class="text-muted small">{{ $label }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Charts --}}
<div class="row g-3">
    <div class="col-lg-7">
        <div class="card stat-card h-100">
            <div class="card-body">
                <h6 class="fw-semibold mb-3"><i class="bi bi-bar-chart-fill text-primary me-2"></i>Students by Course</h6>
                <canvas id="courseChart" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card stat-card h-100">
            <div class="card-body">
                <h6 class="fw-semibold mb-3"><i class="bi bi-pie-chart-fill text-success me-2"></i>Students by Year Level</h6>
                <canvas id="yearChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
const courseLabels = @json($byCourse->keys());
const courseData   = @json($byCourse->values());
const yearLabels   = @json($byYear->keys()->map(fn($y) => 'Year ' . $y));
const yearData     = @json($byYear->values());

new Chart(document.getElementById('courseChart'), {
    type: 'bar',
    data: {
        labels: courseLabels,
        datasets: [{ label: 'Students', data: courseData,
            backgroundColor: 'rgba(26,35,126,.7)', borderRadius: 6 }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});

new Chart(document.getElementById('yearChart'), {
    type: 'doughnut',
    data: {
        labels: yearLabels,
        datasets: [{ data: yearData,
            backgroundColor: ['#1a237e','#1565c0','#0288d1','#00838f'], borderWidth: 2 }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
});
</script>
@endpush
