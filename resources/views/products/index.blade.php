@extends('layouts.app')
@section('title', 'My Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">My Products</h4>
        <small class="text-muted">Manage your product inventory</small>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add Product
    </a>
</div>

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
@endsection
