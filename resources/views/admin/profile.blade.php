@extends('layout.layout')

@php
    $title = 'Admin Profile';
    $subTitle = 'Account Security';
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

    .btn-primary {
        padding: 10px 24px;
        font-weight: 600;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .input-group-text {
        background-color: #f8f9fa !important;
        border: 1.5px solid #dde3ed !important;
        border-right: none !important;
        color: #487FFF !important;
        padding: 0 16px !important;
        border-top-left-radius: 10px !important;
        border-bottom-left-radius: 10px !important;
    }

    .input-group .form-control {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
</style>

<div class="row gy-4">
    <div class="col-md-12">

        {{-- Change Email --}}
        <form action="{{ route('admin.account.updateEmail') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card bg-base mb-24">
                <div class="card-header border-bottom d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:letter-linear" class="text-primary-600 text-xl"></iconify-icon>
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
                                <span class="input-group-text"><iconify-icon icon="solar:letter-outline"></iconify-icon></span>
                                <input type="text" class="form-control bg-neutral-50" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">New Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><iconify-icon icon="solar:letter-opened-outline"></iconify-icon></span>
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
                                <span class="input-group-text"><iconify-icon icon="solar:lock-outline"></iconify-icon></span>
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
                        <iconify-icon icon="solar:check-read-outline"></iconify-icon> Update Email
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
                    <iconify-icon icon="solar:shield-keyhole-linear" class="text-primary-600 text-xl"></iconify-icon>
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
                                <span class="input-group-text"><iconify-icon icon="solar:lock-outline"></iconify-icon></span>
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
                                <span class="input-group-text"><iconify-icon icon="solar:key-minimalistic-outline"></iconify-icon></span>
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
                                <span class="input-group-text"><iconify-icon icon="solar:key-minimalistic-outline"></iconify-icon></span>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top px-24 py-16 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <iconify-icon icon="solar:check-read-outline"></iconify-icon> Update Password
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
