@extends('layout.app')
@section('title', 'Bật OTP SMS')
@section('main')

    <style>
        .step-card {
            border-radius: 1.25rem;
            border: 1px solid #eef0f3;
            transition: 0.25s ease;
        }

        .step-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .sms-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: rgba(59, 113, 202, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }
    </style>

    <div id="kt_app_content" class="app-content flex-column-fluid mt-5">
        <div id="kt_app_content_container" class="app-container container-xxl">
            @if (auth()->user()->two_factor_enabled && auth()->user()->two_factor_type == 'sms')

                <div class="mb-12">
                    <h1 class="fw-bolder fs-2hx mb-4 d-flex align-items-center gap-3">
                        <i class="ki-duotone ki-shield-tick fs-1 text-primary floating-icon"></i>
                        Xác thực hai bước (2FA)
                    </h1>
                    <div class="text-gray-600 fs-5">
                        Tăng cường bảo mật tài khoản bằng mã xác thực thay đổi qua số điện thoại <strong>{{\App\Helpers\Admin\Template::maskPhone(auth()->user()->phone ?? '')}}</strong>
                    </div>
                </div>
                <div class="card card-flush shadow-sm">
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Xác thực 2 bước đã bật</h2>
                        </div>
                    </div>

                    <div class="card-body py-10">

                        <div class="d-flex align-items-center mb-8">
                            <span class="symbol symbol-60px me-4">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-shield-tick fs-2x text-success">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                            </span>
                            <div>
                                <h4 class="fw-semibold mb-1 text-success">Bạn đã bật xác thực hai bước</h4>
                                <div class="text-muted">Tài khoản của bạn đang được bảo vệ bằng số điện thoại.</div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('auth.2fa.disable') }}" class="w-100 mw-400px mx-auto">
                            @csrf
                            <input type="text" name="type" value="google_authenticator" hidden>
                            <button class="btn btn-danger btn-lg w-100">
                                <i class="ki-duotone ki-shield-minus fs-2 me-2"></i>
                                Tắt xác thực 2 bước
                            </button>
                        </form>

                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <div class="card step-card p-10">

                            <div class="text-center mb-8">
                                <div class="sms-icon mb-4">
                                    <i class="bi bi-phone-vibrate fs-1 text-primary"></i>
                                </div>
                                <h2 class="fw-bold">Bật xác thực qua SMS</h2>
                                <div class="text-muted fs-6">
                                    Chúng tôi sẽ gửi mã OTP đến số điện thoại của bạn.
                                </div>
                            </div>

                            {{-- Form nhập số điện thoại --}}
                            <form action="{{ route('auth.2fa.sms.send') }}" method="POST">
                                @csrf

                                <label class="fw-semibold mb-2">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control form-control-lg mb-5"
                                    placeholder="Nhập số điện thoại..." value="{{ old('phone', auth()->user()->phone ?? '') }}" required>

                                <button class="btn btn-primary w-100 py-3 fw-bold">
                                    Gửi mã OTP
                                </button>
                            </form>

                            {{-- Nếu đã gửi mã thì hiện form nhập OTP --}}
                            @if (session('otp_sent'))
                                <hr class="my-8">

                                <form action="{{ route('auth.2fa.sms.verify') }}" method="POST">
                                    @csrf

                                    <label class="fw-semibold mb-2">Nhập mã OTP</label>
                                    <input type="text" name="otp" class="form-control form-control-lg mb-5"
                                        placeholder="Nhập mã gồm 6 chữ số..." maxlength="6" required>

                                    <button class="btn btn-success w-100 py-3 fw-bold">
                                        Xác minh & Bật SMS OTP
                                    </button>

                                    <div class="text-center mt-4">
                                        <a href="{{ route('auth.2fa.sms.send') }}" class="text-primary fw-semibold">
                                            Gửi lại mã
                                        </a>
                                    </div>
                                </form>
                            @endif

                        </div>

                    </div>
                </div>
            @endif



        </div>
    </div>

@endsection
