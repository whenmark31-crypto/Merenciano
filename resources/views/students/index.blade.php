@extends('layouts.app')
@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Student Records</h4>
        <small class="text-muted">Manage all enrolled students</small>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add Student
    </a>
</div>

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
@endsection
