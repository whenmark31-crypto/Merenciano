<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Student ID</label>
        <input type="text" name="student_id" class="form-control @error('student_id') is-invalid @enderror"
               value="{{ old('student_id', $student->student_id ?? '') }}" placeholder="e.g. 2024-0001" required>
        @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Full Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $student->name ?? '') }}" placeholder="Juan Dela Cruz" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $student->email ?? '') }}" placeholder="student@school.edu" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Course</label>
        <select name="course" class="form-select @error('course') is-invalid @enderror" required>
            <option value="">-- Select Course --</option>
            @foreach(['BSIT','BSCS','BSECE','BSEE','BSCE','BSN','BSBA','BSED','BSME','BSARCH'] as $c)
            <option value="{{ $c }}" {{ old('course', $student->course ?? '') == $c ? 'selected' : '' }}>{{ $c }}</option>
            @endforeach
        </select>
        @error('course')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Year Level</label>
        <select name="year_level" class="form-select @error('year_level') is-invalid @enderror" required>
            <option value="">-- Year --</option>
            @foreach([1,2,3,4] as $y)
            <option value="{{ $y }}" {{ old('year_level', $student->year_level ?? '') == $y ? 'selected' : '' }}>Year {{ $y }}</option>
            @endforeach
        </select>
        @error('year_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">GPA <small class="text-muted">(0.00 – 4.00)</small></label>
        <input type="number" name="gpa" step="0.01" min="0" max="4"
               class="form-control @error('gpa') is-invalid @enderror"
               value="{{ old('gpa', $student->gpa ?? '') }}" placeholder="3.50" required>
        @error('gpa')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            @foreach(['Active','Inactive','Graduated'] as $s)
            <option value="{{ $s }}" {{ old('status', $student->status ?? 'Active') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
