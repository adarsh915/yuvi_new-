<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-head />
<style>
    .auth-left img {
        object-fit: cover;
    }

    .icon-field .icon {
        top: 50% !important;
        transform: translateY(-50%) !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 5;
    }

    .icon-field .form-control {
        padding-left: 45px !important;
        position: relative;
        z-index: 1;
    }

    .auth-responsive {
        width: 50%;
    }

    @media (max-width: 991px) {
        .auth-responsive {
            width: 100%;
        }
    }
</style>

<body style="overflow: hidden;">

    <section class="auth bg-base d-flex flex-wrap min-vh-100">
        <div class="auth-left d-lg-block d-none w-50 p-0">
            <div class="h-100 w-100">
                <img src="{{ asset('assets/images/asset/admin.jpg') }}" alt="" class="w-100 h-100 object-fit-cover">
            </div>
        </div>
        <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center auth-responsive">
            <div class="max-w-464-px mx-auto w-100">
                <div>
                    <h4 class="mb-12">Reset Password</h4>
                    <p class="mb-32 text-secondary-light text-lg">Enter your new password below to reset your account
                        access.</p>
                </div>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    @if($errors->any())
                        <div class="alert alert-danger radius-12 mb-16 px-16 py-8">
                            <ul class="mb-0 list-unstyled text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="icon-field mb-16">
                        <span class="icon">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="email" class="form-control h-56-px bg-neutral-50 radius-12"
                            placeholder="Enter Email" value="{{ request()->email }}" required>
                    </div>

                    <div class="icon-field mb-16">
                        <span class="icon">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" name="password" class="form-control h-56-px bg-neutral-50 radius-12"
                            placeholder="New Password" required>
                    </div>

                    <div class="icon-field mb-16">
                        <span class="icon">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" name="password_confirmation"
                            class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Confirm Password"
                            required>
                    </div>

                    <div class="text-center mt-32">
                        <button type="submit" class="btn btn-primary text-sm btn-sm px-60 py-16 radius-12">Reset
                            Password</button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('signin') }}" class="text-primary-600 fw-bold mt-24 d-inline-block">Back to
                            Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <x-script />

</body>

</html>