@extends('layouts.app')
@section('title', 'Add Product')

@section('content')
<div class="mb-4">
    <a href="{{ route('products.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
    <h4 class="fw-bold mt-1 mb-0">Add New Product</h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;max-width:800px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            @include('products._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-save me-1"></i>Save Product
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
