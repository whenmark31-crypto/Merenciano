<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Product Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $product->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Category</label>
        <select name="category" class="form-select @error('category') is-invalid @enderror" required>
            <option value="">-- Select Category --</option>
            @foreach(['Electronics','Clothing','Food','Books','Furniture','Toys','Sports','Beauty'] as $c)
            <option value="{{ $c }}" {{ old('category', $product->category ?? '') == $c ? 'selected' : '' }}>{{ $c }}</option>
            @endforeach
        </select>
        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Price (₱)</label>
        <input type="number" name="price" step="0.01" min="0"
               class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $product->price ?? '') }}" required>
        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Quantity</label>
        <input type="number" name="quantity" min="0"
               class="form-control @error('quantity') is-invalid @enderror"
               value="{{ old('quantity', $product->quantity ?? '') }}" required>
        @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
