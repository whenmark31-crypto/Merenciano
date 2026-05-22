@extends('layouts.app')
@section('title', 'Users Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Users Management</h4>
        <small class="text-muted">Manage system users</small>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add User
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Created Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td><span class="badge bg-secondary">#{{ $user->id }}</span></td>
                        <td class="fw-semibold">{{ $user->name }}</td>
                        <td class="text-muted small">{{ $user->email }}</td>
                        <td>{{ $user->gender ?? 'N/A' }}</td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td class="small">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline"
                                  onsubmit="return confirm('Delete {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-4 text-muted">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer bg-transparent d-flex justify-content-end">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
