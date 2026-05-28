@extends('layouts.app')
@section('title', 'Users Management')

@push('styles')
<style>
    .user-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        transition: all 0.2s;
    }
    .user-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .user-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.75rem;
    }
    .user-name {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }
    .user-email {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }
    .user-info {
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
    .user-actions {
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
        <h4 class="fw-bold mb-0">Users Management</h4>
        <small class="text-muted">Manage system users</small>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary">
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
</div>

<div class="mobile-view">
    @forelse($users as $user)
    <div class="user-card">
        <div class="user-header">
            <div>
                <div class="user-name">{{ $user->name }}</div>
                <div class="user-email">
                    <i class="bi bi-envelope"></i> {{ $user->email }}
                </div>
            </div>
            <span class="badge bg-secondary">#{{ $user->id }}</span>
        </div>
        
        <div class="user-info">
            <div class="info-item">
                <div class="info-label">Gender</div>
                <div class="info-value">{{ $user->gender ?? 'N/A' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Phone</div>
                <div class="info-value">{{ $user->phone ?? 'N/A' }}</div>
            </div>
            <div class="info-item" style="grid-column: 1 / -1;">
                <div class="info-label">Joined</div>
                <div class="info-value">{{ $user->created_at->format('M d, Y') }}</div>
            </div>
        </div>
        
        <div class="user-actions">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary flex-fill">
                <i class="bi bi-pencil-fill me-1"></i>Edit
            </a>
            <form method="POST" action="{{ route('users.destroy', $user) }}" class="flex-fill"
                  onsubmit="return confirm('Delete {{ $user->name }}?')">
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
        <p class="mt-3">No users found.</p>
    </div>
    @endforelse
    
    @if($users->hasPages())
    <div class="d-flex justify-content-center mt-3">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
