@extends('layout.layout')

@php
    $title = 'Site Settings';
    $subTitle = 'Manage Header & Footer';
@endphp

@section('content')
<style>
    .card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: none;
    }

    .card-header {
        padding: 10px 20px !important;
        background: #fff !important;
        border-bottom: 1px solid #e9ecef !important;
    }

    .form-label {
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d !important;
    }

    .logo-preview-wrapper {
        background: #f8f9fa;
        padding: 16px;
        border-radius: 12px;
        border: 1px dashed #dee2e6;
        display: inline-block;
        margin-bottom: 12px;
    }

    .btn-primary {
        padding: 10px 24px;
        font-weight: 600;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
</style>

<div class="row gy-4">
    <div class="col-md-12">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Branding Section -->
            <div class="card bg-base mb-24">
                <div class="card-header border-bottom d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:globus-outline" class="text-primary-600"></iconify-icon>
                    <h6 class="text-lg fw-semibold mb-0">Logo & Branding</h6>
                </div>
                <div class="card-body p-24">
                    <div class="row gy-4">
                        <div class="col-md-6 border-end">
                            <label class="form-label mb-8">Header Logo</label>
                            <div class="logo-preview-wrapper">
                                @php $hLogo = $settings->where('key', 'header_logo')->first()->value ?? ''; @endphp
                                <img src="{{ asset(str_contains($hLogo, 'settings/') ? 'storage/' . $hLogo : $hLogo) }}"
                                    alt="Header Logo"
                                    style="max-height: 80px; object-fit: contain;">
                            </div>
                            <input type="file" name="files[header_logo]" class="form-control">
                            <p class="text-xs text-secondary-light mt-8">
                                <iconify-icon icon="solar:info-circle-outline"></iconify-icon>
                                Recommended: 300x120px (PNG with transparency)
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">Footer Logo</label>
                            <div class="logo-preview-wrapper">
                                @php $fLogo = $settings->where('key', 'footer_logo')->first()->value ?? ''; @endphp
                                <img src="{{ asset(str_contains($fLogo, 'settings/') ? 'storage/' . $fLogo : $fLogo) }}"
                                    alt="Footer Logo"
                                    style="max-height: 80px; object-fit: contain;">
                            </div>
                            <input type="file" name="files[footer_logo]" class="form-control">
                            <p class="text-xs text-secondary-light mt-8">
                                <iconify-icon icon="solar:info-circle-outline"></iconify-icon>
                                Recommended: 300x120px (PNG with transparency)
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Details Section -->
            <div class="card bg-base mb-24">
                <div class="card-header border-bottom d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:align-bottom-outline" class="text-primary-600"></iconify-icon>
                    <h6 class="text-lg fw-semibold mb-0">Footer Information</h6>
                </div>
                <div class="card-body p-24">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <label class="form-label mb-8">Footer Description</label>
                            <textarea name="settings[footer_description]" class="form-control" rows="4" placeholder="Brief about the clinic...">{{ $settings->where('key', 'footer_description')->first()->value ?? '' }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label mb-8">Support Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><iconify-icon icon="solar:letter-outline"></iconify-icon></span>
                                <input type="email" name="settings[footer_email]" class="form-control"
                                    value="{{ $settings->where('key', 'footer_email')->first()->value ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label mb-8">Support Phone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><iconify-icon icon="solar:phone-outline"></iconify-icon></span>
                                <input type="text" name="settings[footer_phone]" class="form-control"
                                    value="{{ $settings->where('key', 'footer_phone')->first()->value ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label mb-8">Clinic Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><iconify-icon icon="solar:map-point-outline"></iconify-icon></span>
                                <input type="text" name="settings[footer_address]" class="form-control"
                                    value="{{ $settings->where('key', 'footer_address')->first()->value ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-24">
                <button type="submit" class="btn btn-primary shadow-sm">
                    <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                    Update Site Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
