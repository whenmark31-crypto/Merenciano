@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
<div class="mb-4">
    <a href="{{ route('profile.show') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i>Back to Profile
    </a>
    <h4 class="fw-bold mt-1 mb-0">Edit Profile</h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;max-width:800px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            
            <div class="text-center mb-4">
                @if(Auth::user()->profile_picture_base64)
                    <img src="{{ Auth::user()->profile_picture_base64 }}" class="rounded-circle mb-2" width="120" height="120" style="object-fit:cover;" id="previewImg">
                @else
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width:120px;height:120px;" id="previewDiv">
                        <i class="bi bi-person-fill text-primary" style="font-size:3rem;"></i>
                    </div>
                @endif
                <div>
                    <label for="profile_picture" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-camera-fill me-1"></i>Change Picture
                    </label>
                    <input type="file" name="profile_picture" id="profile_picture" class="d-none" accept="image/*">
                    @error('profile_picture')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', Auth::user()->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Gender</label>
                    <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                        <option value="">-- Select --</option>
                        @foreach(['Male','Female','Other'] as $g)
                        <option value="{{ $g }}" {{ old('gender', Auth::user()->gender) == $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                    @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', Auth::user()->phone) }}">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                           value="{{ old('address', Auth::user()->address) }}">
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-12"><hr></div>
                <div class="col-12"><h6 class="fw-bold">Change Password <small class="text-muted">(optional)</small></h6></div>
                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">New Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-check-lg me-1"></i>Update Profile
                </button>
                <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('profile_picture').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Remove old preview
            const oldImg = document.getElementById('previewImg');
            const oldDiv = document.getElementById('previewDiv');
            
            if (oldImg) {
                oldImg.src = e.target.result;
            } else if (oldDiv) {
                oldDiv.outerHTML = `<img src="${e.target.result}" class="rounded-circle mb-2" width="120" height="120" style="object-fit:cover;" id="previewImg">`;
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
