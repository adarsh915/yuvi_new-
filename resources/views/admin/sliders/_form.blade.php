@php
    $isEdit = $slider->exists;
    $imagePreview = $isEdit && $slider->image ? asset('storage/' . $slider->image) : null;
@endphp

<div class="row gy-20">
    <div class="col-md-8">
        <div class="card border p-16 radius-12 bg-base h-100">
            <div class="col-12">
                <label class="form-label fw-semibold text-sm mb-8">Slider Image <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control radius-8" accept="image/*" {{ $isEdit ? '' : 'required' }}>
                @error('image')
                    <div class="text-danger text-sm mt-4">{{ $message }}</div>
                @enderror

                @if($imagePreview)
                    <div class="mt-12">
                        <img src="{{ $imagePreview }}" alt="Slider image" class="radius-8" style="width: 100%; max-width: 420px; height: 180px; object-fit: cover;">
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border p-16 radius-12 bg-base">
            <div class="row gy-20">
                <div class="col-12">
                    <label class="form-label fw-semibold text-sm mb-8">Display Order <span class="text-danger">*</span></label>
                    <input type="number" name="order" class="form-control radius-8" value="{{ old('order', $slider->order ?? 0) }}" min="0" required>
                    @error('order')
                        <div class="text-danger text-sm mt-4">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <div class="form-check form-switch d-flex align-items-center gap-3">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $slider->exists ? $slider->is_active : true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Active</label>
                    </div>
                </div>

                <div class="col-12 mt-20">
                    <button type="submit" class="btn btn-primary w-100 radius-8">{{ $submitButtonText ?? 'Save Slider' }}</button>
                </div>
            </div>
        </div>
    </div>
</div>