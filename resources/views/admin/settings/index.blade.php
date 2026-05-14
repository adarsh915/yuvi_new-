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

            <!-- Media Page Banner Section -->
            <div class="card bg-base mb-24">
                <div class="card-header border-bottom d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:gallery-bold-duotone" class="text-primary-600"></iconify-icon>
                    <h6 class="text-lg fw-semibold mb-0">Media Page Banner</h6>
                </div>
                <div class="card-body p-24">
                    <div class="row gy-4">
                        <div class="col-md-6 border-end">
                            <label class="form-label mb-8">Banner Image</label>
                            <div class="logo-preview-wrapper d-block">
                                @php $mBanner = $settings->where('key', 'media_banner_image')->first()->value ?? ''; @endphp
                                @if($mBanner)
                                    <img src="{{ asset(str_contains($mBanner, 'settings/') ? 'storage/' . $mBanner : $mBanner) }}"
                                        alt="Media Banner"
                                        style="max-height: 150px; width: 100%; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div class="text-secondary-light text-xs p-20 text-center">No banner uploaded</div>
                                @endif
                            </div>
                            <input type="file" name="files[media_banner_image]" class="form-control mt-12">
                            <p class="text-xs text-secondary-light mt-8">
                                <iconify-icon icon="solar:info-circle-outline"></iconify-icon>
                                Recommended: 1920x800px (High Resolution)
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-20">
                                <label class="form-label mb-8">Banner Title</label>
                                <input type="text" name="settings[media_banner_title]" class="form-control"
                                    value="{{ $settings->where('key', 'media_banner_title')->first()->value ?? '' }}" placeholder="e.g. Stories, Science & Clinical Insights">
                            </div>
                            <div class="mb-0">
                                <label class="form-label mb-8">Banner Description</label>
                                <textarea name="settings[media_banner_description]" class="form-control" rows="4" placeholder="Brief description for the media page...">{{ $settings->where('key', 'media_banner_description')->first()->value ?? '' }}</textarea>
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

{{-- Account Security Section (separate form) --}}
<div class="row gy-4 mt-0">
    <div class="col-md-12">

        {{-- Change Email --}}
        <form action="{{ route('admin.account.updateEmail') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card bg-base mb-24">
                <div class="card-header border-bottom d-flex align-items-center gap-2">
                    <i class="ri-mail-settings-line text-primary-600 text-xl"></i>
                    <h6 class="text-lg fw-semibold mb-0">Change Admin Email</h6>
                </div>
                <div class="card-body p-24">

                    @if(session('email_success'))
                        <div class="alert alert-success radius-8 mb-16 px-16 py-10 text-sm">
                            <i class="ri-checkbox-circle-line me-1"></i> {{ session('email_success') }}
                        </div>
                    @endif
                    @if($errors->hasBag('email_update'))
                        <div class="alert alert-danger radius-8 mb-16 px-16 py-10 text-sm">
                            @foreach($errors->getBag('email_update')->all() as $error)
                                <div><i class="ri-error-warning-line me-1"></i> {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label mb-8">Current Admin Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ri-mail-line"></i></span>
                                <input type="text" class="form-control bg-neutral-50" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">New Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ri-mail-send-line"></i></span>
                                <input type="email" name="email" class="form-control {{ $errors->email_update->has('email') ? 'is-invalid' : '' }}" 
                                    placeholder="Enter new email address" value="{{ old('email') }}" required>
                            </div>
                            @if($errors->email_update->has('email'))
                                <div class="text-danger text-xs mt-4">{{ $errors->email_update->first('email') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">Confirm with Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ri-lock-line"></i></span>
                                <input type="password" name="current_password" class="form-control {{ $errors->email_update->has('current_password') ? 'is-invalid' : '' }}" 
                                    placeholder="Enter current password to confirm" required>
                            </div>
                            @if($errors->email_update->has('current_password'))
                                <div class="text-danger text-xs mt-4">{{ $errors->email_update->first('current_password') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top px-24 py-16 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="ri-mail-check-line"></i> Update Email
                    </button>
                </div>
            </div>
        </form>

        {{-- Change Password --}}
        <form action="{{ route('admin.account.updatePassword') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card bg-base mb-24">
                <div class="card-header border-bottom d-flex align-items-center gap-2">
                    <i class="ri-shield-keyhole-line text-primary-600 text-xl"></i>
                    <h6 class="text-lg fw-semibold mb-0">Change Admin Password</h6>
                </div>
                <div class="card-body p-24">

                    @if(session('password_success'))
                        <div class="alert alert-success radius-8 mb-16 px-16 py-10 text-sm">
                            <i class="ri-checkbox-circle-line me-1"></i> {{ session('password_success') }}
                        </div>
                    @endif
                    @if($errors->hasBag('password_update'))
                        <div class="alert alert-danger radius-8 mb-16 px-16 py-10 text-sm">
                            @foreach($errors->getBag('password_update')->all() as $error)
                                <div><i class="ri-error-warning-line me-1"></i> {{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="row gy-3">
                        <div class="col-md-4">
                            <label class="form-label mb-8">Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ri-lock-line"></i></span>
                                <input type="password" name="current_password" class="form-control {{ $errors->password_update->has('current_password') ? 'is-invalid' : '' }}" 
                                    placeholder="Current password" required>
                            </div>
                            @if($errors->password_update->has('current_password'))
                                <div class="text-danger text-xs mt-4">{{ $errors->password_update->first('current_password') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="form-label mb-8">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ri-lock-password-line"></i></span>
                                <input type="password" name="password" class="form-control {{ $errors->password_update->has('password') ? 'is-invalid' : '' }}" 
                                    placeholder="Min. 8 characters" required>
                            </div>
                            @if($errors->password_update->has('password'))
                                <div class="text-danger text-xs mt-4">{{ $errors->password_update->first('password') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="form-label mb-8">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="ri-lock-password-line"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top px-24 py-16 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="ri-shield-check-line"></i> Update Password
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
