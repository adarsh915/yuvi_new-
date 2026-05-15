@php
    $isEdit = $slider->exists;
    $imagePreview = $isEdit && $slider->image ? asset('storage/' . $slider->image) : null;
@endphp

<style>
    .form-label {
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d !important;
    }
    
    .preview-box {
        background: #f8f9fa;
        border: 1px dashed #dee2e6;
        border-radius: 12px;
        padding: 16px;
        margin-top: 12px;
    }

    /* ── Toggle Row ── */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 14px;
        background: #f8f9fb;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        cursor: pointer;
        transition: all .15s;
        margin: 0;
    }
    .toggle-row:hover { background: #fff; border-color: #dee2e6; }
    .toggle-row .tr-label { font-size: 13px; font-weight: 600; color: #1a1a2e; display: block; }
    .toggle-row .tr-sub { font-size: 11px; color: #868e96; display: block; margin-top: 1px; }
    .toggle-row .form-check { padding: 0; margin: 0; }
    .toggle-row .form-check-input {
        width: 40px !important;
        height: 22px !important;
        cursor: pointer;
        margin: 0 !important;
        flex-shrink: 0;
    }
</style>

<div class="row gy-4">
    <div class="col-md-8">
        <div class="card p-24 radius-12 bg-base h-100">
            <div class="mb-0">
                <label class="form-label mb-8">Slider Image <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><iconify-icon icon="solar:gallery-outline"></iconify-icon></span>
                    <input type="file" name="image" class="form-control" accept="image/*" {{ $isEdit ? '' : 'required' }}>
                </div>
                @error('image')
                    <div class="text-danger text-xs mt-4">{{ $message }}</div>
                @enderror

                @if($imagePreview)
                    <div class="preview-box">
                        <label class="form-label mb-8 d-block">Current Preview</label>
                        <img src="{{ $imagePreview }}" alt="Slider image" class="radius-8 shadow-sm" style="width: 100%; max-height: 300px; object-fit: cover;">
                    </div>
                @endif
                <p class="text-xs text-secondary-light mt-12">
                    <iconify-icon icon="solar:info-circle-outline"></iconify-icon>
                    Upload a high-resolution image for the homepage banner. Recommended size: 1600 x 694 pixels.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-24 radius-12 bg-base h-100">
            <div class="mb-24">
                <label class="form-label mb-8">Display Order <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><iconify-icon icon="solar:sort-from-top-to-bottom-outline"></iconify-icon></span>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $isEdit ? $slider->order : '') }}" min="0" placeholder="{{ $isEdit ? '' : 'Leave empty for next available' }}">
                </div>
                @error('order')
                    <div class="text-danger text-xs mt-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-32">
                <label class="toggle-row" for="is_active">
                    <div>
                        <span class="tr-label">Active</span>
                        <span class="tr-sub">Show this slider on homepage</span>
                    </div>
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $slider->exists ? $slider->is_active : true) ? 'checked' : '' }}>
                    </div>
                </label>
            </div>

            <div class="mt-auto">
                <button type="submit" class="btn btn-primary w-100 radius-8 d-flex align-items-center justify-content-center gap-2 py-12">
                    <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                    {{ $submitButtonText ?? 'Save Slider' }}
                </button>
            </div>
        </div>
    </div>
</div>