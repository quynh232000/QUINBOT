@extends('layout.app')
@section('title', 'Manage Users')
@section('main')

    @push('css')
        <style>
            .card-hover:hover {
                transform: translateY(-4px);
                transition: 0.25s ease;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            }

            .option-card {
                border: 2px solid transparent;
                border-radius: 1rem;
                transition: 0.25s ease;
            }

            .option-card:hover {
                transform: translateY(-4px);
                border-color: rgba(0, 0, 0, 0.05);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            }

            .option-card.active-option {
                border-color: var(--bs-primary) !important;
                box-shadow: 0 0 0 4px rgba(59, 113, 202, 0.15) !important;
                transform: translateY(-4px);
            }

            .card-hover:hover {
                transform: translateY(-4px);
                transition: 0.25s ease;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            }

            .option-card {
                border: 2px solid transparent;
                border-radius: 1rem;
                transition: 0.25s ease;
            }

            .option-card:hover {
                transform: translateY(-4px);
                border-color: rgba(239, 124, 1, 0.05);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            }

            /* ACTIVE STATE */
            .option-card.active-option {
                border-color: var(--bs-primary) !important;
                background-color: rgba(250, 115, 11, 0.06) !important;
                /* ⭐ nền nhẹ */
                box-shadow: 0 0 0 4px rgba(9, 103, 253, 0.15) !important;
                transform: translateY(-4px);
            }
        </style>
    @endpush

    <div id="kt_app_content" class="app-content flex-column-fluid" style="padding: 0">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="text-center mb-10">
                <h1 class="fw-bold">Chọn phương thức xác thực</h1>
                <div class="text-muted fs-5">Vui lòng chọn một cách để nhận mã xác minh</div>
            </div>

            <div class="row g-7 justify-content-center">

                <!-- OTP EMAIL -->
                <div class="col-md-4">
                    <a href="{{ route('auth.2fa.setup.type', ['type' => 'email']) }}"
                        class="card card-flush h-100 option-card card-hover shadow-sm
                   {{ $type == 'email' ? 'active-option' : '' }}">
                        <div class="card-body text-center py-10">

                            <div class="symbol symbol-70px symbol-circle mb-5">
                                <span class="symbol-label bg-light-primary">
                                    <i class="bi bi-envelope-paper fs-1 text-primary"></i>
                                </span>
                            </div>

                            <h3 class="fw-bold mb-2">OTP Email</h3>
                            <div class="text-muted fs-6">Nhận mã xác minh qua email của bạn</div>
                        </div>
                    </a>
                </div>

                <!-- OTP SMS -->
                <div class="col-md-4">
                    <a href="{{ route('auth.2fa.setup.type', ['type' => 'sms']) }}"
                        class="card card-flush h-100 option-card card-hover shadow-sm
                   {{ $type == 'sms' ? 'active-option' : '' }}">
                        <div class="card-body text-center py-10">

                            <div class="symbol symbol-70px symbol-circle mb-5">
                                <span class="symbol-label bg-light-info">
                                    <i class="bi bi-phone-vibrate fs-1 text-info"></i>
                                </span>
                            </div>

                            <h3 class="fw-bold mb-2">OTP SMS</h3>
                            <div class="text-muted fs-6">Nhận mã OTP qua số điện thoại của bạn</div>
                        </div>
                    </a>
                </div>

                <!-- App Authenticator -->
                <div class="col-md-4">
                    <a href="{{ route('auth.2fa.setup.type', ['type' => 'google_authenticator']) }}"
                        class="card card-flush h-100 option-card card-hover shadow-sm
                   {{ $type == 'google_authenticator' ? 'active-option' : '' }}">
                        <div class="card-body text-center py-10">

                            <div class="symbol symbol-70px symbol-circle mb-5">
                                <span class="symbol-label bg-light-success">
                                    <i class="bi bi-shield-lock fs-1 text-success"></i>
                                </span>
                            </div>

                            <h3 class="fw-bold mb-2">App Authenticator</h3>
                            <div class="text-muted fs-6">Google Authenticator, Authy hoặc ứng dụng TOTP khác</div>
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </div>

@endsection
