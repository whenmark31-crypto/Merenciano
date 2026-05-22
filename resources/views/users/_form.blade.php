<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Full Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email ?? '') }}" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Password @if(isset($user))<small class="text-muted">(leave blank to keep current)</small>@endif</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" {{ isset($user) ? '' : 'required' }}>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Gender</label>
        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
            <option value="">-- Select --</option>
            @foreach(['Male','Female','Other'] as $g)
            <option value="{{ $g }}" {{ old('gender', $user->gender ?? '') == $g ? 'selected' : '' }}>{{ $g }}</option>
            @endforeach
        </select>
        @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Phone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
               value="{{ old('phone', $user->phone ?? '') }}">
        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Address</label>
        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
               value="{{ old('address', $user->address ?? '') }}">
        @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
