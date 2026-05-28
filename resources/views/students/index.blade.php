@extends('layouts.app')
@section('title', 'Students')

@push('styles')
<style>
    .student-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        transition: all 0.2s;
    }
    .student-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .student-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.75rem;
    }
    .student-name {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }
    .student-id {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }
    .student-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }
    .info-item {
        font-size: 0.85rem;
    }
    .info-label {
        color: var(--text-secondary);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-value {
        color: var(--text-primary);
        font-weight: 600;
    }
    .student-actions {
        display: flex;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid var(--border-color);
    }
    @media (min-width: 768px) {
        .mobile-view { display: none; }
        .desktop-view { display: block; }
    }
    @media (max-width: 767px) {
        .mobile-view { display: block; }
        .desktop-view { display: none; }
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Student Records</h4>
        <small class="text-muted">Manage all enrolled students</small>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add
    </a>
</div>

<div class="desktop-view">
    <div class="card border-0 shadow-sm" style="border-radius:12px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Year</th>
                            <th>GPA</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $student->student_id }}</span></td>
                            <td class="fw-semibold">{{ $student->name }}</td>
                            <td class="text-muted small">{{ $student->email }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td>
                                <span class="badge {{ $student->gpa >= 3 ? 'bg-success' : ($student->gpa >= 2 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                    {{ number_format($student->gpa, 2) }}
                                </span>
                            </td>
                            <td>
                                @php $colors = ['Active'=>'success','Inactive'=>'secondary','Graduated'=>'info']; @endphp
                                <span class="badge bg-{{ $colors[$student->status] ?? 'secondary' }}">{{ $student->status }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline"
                                      onsubmit="return confirm('Delete {{ $student->name }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center py-4 text-muted">No students found. <a href="{{ route('students.create') }}">Add one</a>.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($students->hasPages())
        <div class="card-footer bg-transparent d-flex justify-content-end">
            {{ $students->links() }}
        </div>
        @endif
    </div>
</div>

<div class="mobile-view">
    @forelse($students as $student)
    <div class="student-card">
        <div class="student-header">
            <div>
                <div class="student-name">{{ $student->name }}</div>
                <div class="student-id">
                    <i class="bi bi-hash"></i>{{ $student->student_id }}
                </div>
            </div>
            <div>
                @php $colors = ['Active'=>'success','Inactive'=>'secondary','Graduated'=>'info']; @endphp
                <span class="badge bg-{{ $colors[$student->status] ?? 'secondary' }}">{{ $student->status }}</span>
            </div>
        </div>
        
        <div class="student-info">
            <div class="info-item">
                <div class="info-label">Course</div>
                <div class="info-value">{{ $student->course }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Year</div>
                <div class="info-value">Year {{ $student->year_level }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">GPA</div>
                <div class="info-value">
                    <span class="badge {{ $student->gpa >= 3 ? 'bg-success' : ($student->gpa >= 2 ? 'bg-warning text-dark' : 'bg-danger') }}">
                        {{ number_format($student->gpa, 2) }}
                    </span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value" style="font-size: 0.8rem; word-break: break-all;">{{ $student->email }}</div>
            </div>
        </div>
        
        <div class="student-actions">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-primary flex-fill">
                <i class="bi bi-pencil-fill me-1"></i>Edit
            </a>
            <form method="POST" action="{{ route('students.destroy', $student) }}" class="flex-fill"
                  onsubmit="return confirm('Delete {{ $student->name }}?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger w-100">
                    <i class="bi bi-trash-fill me-1"></i>Delete
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center py-5 text-muted">
        <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
        <p class="mt-3">No students found.</p>
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">Add Student</a>
    </div>
    @endforelse
    
    @if($students->hasPages())
    <div class="d-flex justify-content-center mt-3">
        {{ $students->links() }}
    </div>
    @endif
</div>
@endsection
