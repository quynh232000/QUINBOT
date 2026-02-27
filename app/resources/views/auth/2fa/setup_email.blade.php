@extends('layout.app')
@section('title', 'Bật OTP Email')
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

        .email-icon {
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
            @if (auth()->user()->two_factor_enabled && auth()->user()->two_factor_type == 'email')

                <div class="mb-12">
                    <h1 class="fw-bolder fs-2hx mb-4 d-flex align-items-center gap-3">
                        <i class="ki-duotone ki-shield-tick fs-1 text-primary floating-icon"></i>
                        Xác thực hai bước (2FA)
                    </h1>
                    <div class="text-gray-600 fs-5">
                        Tăng cường bảo mật tài khoản bằng mã xác thực qua email.
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
                                <div class="text-muted">Tài khoản của bạn đang được bảo vệ qua Email.</div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('auth.2fa.disable') }}" class="w-100 mw-400px mx-auto">
                            @csrf
                            <input type="text" name="type" value="email" hidden>
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
                                <div class="email-icon mb-4">
                                    <i class="bi bi-envelope-check fs-1 text-primary"></i>
                                </div>
                                <h2 class="fw-bold">Bật xác thực qua Email</h2>
                                <div class="text-muted fs-6">
                                    Mã OTP sẽ được gửi đến email của bạn.
                                </div>
                            </div>

                            {{-- Form gửi mã OTP --}}
                            <form action="{{ route('auth.2fa.email.send') }}" method="POST">
                                @csrf

                                <label class="fw-semibold mb-2">Email</label>
                                <input type="email" class="form-control form-control-lg mb-5"
                                    value="{{ auth()->user()->email }}" disabled>

                                <button class="btn btn-primary w-100 py-3 fw-bold">
                                    Gửi mã OTP đến Email
                                </button>
                            </form>

                            {{-- Hiện form nhập OTP nếu đã gửi --}}
                            @if (session('otp_sent'))
                                <hr class="my-8">

                                <form action="{{ route('auth.2fa.email.verify') }}" method="POST">
                                    @csrf

                                    <label class="fw-semibold mb-2">Nhập mã OTP</label>
                                    <input type="text" name="otp" class="form-control form-control-lg mb-5"
                                        placeholder="Nhập mã gồm 6 chữ số..." maxlength="6" required>

                                    <button class="btn btn-success w-100 py-3 fw-bold">
                                        Xác minh & Bật Email OTP
                                    </button>

                                </form>
                                <div class="text-center mt-4">
                                    <form action="{{ route('auth.2fa.email.send') }}" method="POST">
                                        @csrf
                                        <input hidden type="email" class="form-control form-control-lg mb-5"
                                            value="{{ auth()->user()->email }}" disabled>

                                        <button style="outline: none; border: none; background-color: transparent;"
                                            class=" text-primary fw-semibold">
                                            Gửi lại mã
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            @endif


        </div>
    </div>

@endsection

@push('js2')
@endpush
