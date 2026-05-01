@extends('layout.layout')

@php
    $title = 'Site Settings';
    $subTitle = 'Manage Header & Footer';
@endphp

@section('content')
<div class="row gy-4">
    <div class="col-md-12">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Branding Section -->
            <div class="card p-0 radius-12 bg-base mb-4">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Logo & Branding</h6>
                </div>
                <div class="card-body p-24">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm mb-8">Header Logo (Dark)</label>
                            <div class="mb-12">
                                @php $hLogo = $settings->where('key', 'header_logo')->first()->value ?? ''; @endphp
                                <img src="{{ asset(str_contains($hLogo, 'settings/') ? 'storage/'.$hLogo : $hLogo) }}" alt="Header Logo" style="max-height: 80px; background: #eee; padding: 10px; border-radius: 8px;">
                            </div>
                            <input type="file" name="files[header_logo]" class="form-control">
                            <p class="text-xs text-secondary-light mt-8">Recommended size: 300x120px (PNG with transparency)</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm mb-8">Footer Logo (Light)</label>
                            <div class="mb-12">
                                @php $fLogo = $settings->where('key', 'footer_logo')->first()->value ?? ''; @endphp
                                <img src="{{ asset(str_contains($fLogo, 'settings/') ? 'storage/'.$fLogo : $fLogo) }}" alt="Footer Logo" style="max-height: 80px; background: #333; padding: 10px; border-radius: 8px;">
                            </div>
                            <input type="file" name="files[footer_logo]" class="form-control">
                            <p class="text-xs text-secondary-light mt-8">Used on dark backgrounds (PNG with transparency)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Details Section -->
            <div class="card p-0 radius-12 bg-base mb-4">
                <div class="card-header border-bottom bg-base py-16 px-24">
                    <h6 class="text-lg fw-semibold mb-0">Footer Information</h6>
                </div>
                <div class="card-body p-24">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold text-sm mb-8">Footer Description</label>
                            <textarea name="settings[footer_description]" class="form-control" rows="3">{{ $settings->where('key', 'footer_description')->first()->value ?? '' }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm mb-8">Support Email</label>
                            <input type="email" name="settings[footer_email]" class="form-control" value="{{ $settings->where('key', 'footer_email')->first()->value ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm mb-8">Support Phone</label>
                            <input type="text" name="settings[footer_phone]" class="form-control" value="{{ $settings->where('key', 'footer_phone')->first()->value ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-sm mb-8">Clinic Address</label>
                            <input type="text" name="settings[footer_address]" class="form-control" value="{{ $settings->where('key', 'footer_address')->first()->value ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-32 py-12 radius-8">Update Site Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
