@extends('layouts.app')
@section('title', 'My Products')

@push('styles')
<style>
    .product-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        transition: all 0.2s;
    }
    .product-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }
    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 0.75rem;
    }
    .product-name {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }
    .product-category {
        font-size: 0.85rem;
    }
    .product-info {
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
    .product-actions {
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
        <h4 class="fw-bold mb-0">My Products</h4>
        <small class="text-muted">Manage your product inventory</small>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
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
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Created</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td><span class="badge bg-secondary">#{{ $product->id }}</span></td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td><span class="badge bg-info">{{ $product->category }}</span></td>
                            <td class="text-success fw-bold">₱{{ number_format($product->price, 2) }}</td>
                            <td>
                                <span class="badge {{ $product->quantity > 10 ? 'bg-success' : ($product->quantity > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                    {{ $product->quantity }} pcs
                                </span>
                            </td>
                            <td class="small">{{ $product->created_at->format('M d, Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline"
                                      onsubmit="return confirm('Delete {{ $product->name }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-4 text-muted">No products found. <a href="{{ route('products.create') }}">Add one</a>.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($products->hasPages())
        <div class="card-footer bg-transparent d-flex justify-content-end">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>

<div class="mobile-view">
    @forelse($products as $product)
    <div class="product-card">
        <div class="product-header">
            <div>
                <div class="product-name">{{ $product->name }}</div>
                <div class="product-category">
                    <span class="badge bg-info">{{ $product->category }}</span>
                </div>
            </div>
            <span class="badge bg-secondary">#{{ $product->id }}</span>
        </div>
        
        <div class="product-info">
            <div class="info-item">
                <div class="info-label">Price</div>
                <div class="info-value text-success">₱{{ number_format($product->price, 2) }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Stock</div>
                <div class="info-value">
                    <span class="badge {{ $product->quantity > 10 ? 'bg-success' : ($product->quantity > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                        {{ $product->quantity }} pcs
                    </span>
                </div>
            </div>
            <div class="info-item" style="grid-column: 1 / -1;">
                <div class="info-label">Added</div>
                <div class="info-value">{{ $product->created_at->format('M d, Y') }}</div>
            </div>
        </div>
        
        <div class="product-actions">
            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary flex-fill">
                <i class="bi bi-pencil-fill me-1"></i>Edit
            </a>
            <form method="POST" action="{{ route('products.destroy', $product) }}" class="flex-fill"
                  onsubmit="return confirm('Delete {{ $product->name }}?')">
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
        <p class="mt-3">No products found.</p>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Add Product</a>
    </div>
    @endforelse
    
    @if($products->hasPages())
    <div class="d-flex justify-content-center mt-3">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
