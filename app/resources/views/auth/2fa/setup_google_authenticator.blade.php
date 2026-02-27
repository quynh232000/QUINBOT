@extends('layout.app')
@section('title', 'Manage Users')
@section('main')
    <style>
        /* Floating icons */
        .floating-icon {
            animation: floatIcon 3s ease-in-out infinite;
        }

        @keyframes floatIcon {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-7px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Glow effect */
        .glow-box {
            box-shadow: 0 0 25px rgba(0, 123, 255, 0.3);
        }

        /* Soft pulse around QR */
        .qr-pulse {
            position: relative;
        }

        .qr-pulse::after {
            content: "";
            position: absolute;
            inset: -10px;
            border-radius: 12px;
            border: 2px dashed rgba(59, 113, 202, 0.4);
            animation: pulseBorder 2s infinite linear;
        }

        @keyframes pulseBorder {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            100% {
                opacity: 0;
                transform: scale(1.15);
            }
        }

        /* Button hover scale */
        .btn-animated {
            transition: all .25s ease;
        }

        .btn-animated:hover {
            transform: scale(1.04) translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.35);
        }
    </style>

    <div id="kt_app_content" class="app-content flex-column-fluid" style="padding: 0">
        <div id="kt_app_content_container" class="app-container container-xxl">

            @if (auth()->user()->two_factor_enabled && auth()->user()->two_factor_type == 'google_authenticator')

                <div class="mb-12">
                    <h1 class="fw-bolder fs-2hx mb-4 d-flex align-items-center gap-3">
                        <i class="ki-duotone ki-shield-tick fs-1 text-primary floating-icon"></i>
                        Xác thực hai bước (2FA)
                    </h1>
                    <div class="text-gray-600 fs-5">
                        Tăng cường bảo mật tài khoản bằng mã xác thực thay đổi mỗi 30 giây.
                    </div>
                </div>
                <div class="row d-flex">
                    <div class="col-md-6 p-2">
                        <div class="card card-flush shadow-sm ">
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
                                        <div class="text-muted">Tài khoản của bạn đang được bảo vệ bằng Google
                                            Authenticator.</div>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('auth.2fa.disable') }}"
                                    class="w-100 mw-400px mx-auto">
                                    @csrf
                                    <input type="text" name="type" value="google_authenticator" hidden>
                                    <button class="btn btn-danger btn-lg w-100">
                                        <i class="ki-duotone ki-shield-minus fs-2 me-2"></i>
                                        Tắt xác thực 2 bước
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 p-2">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-7">

                                <h4 class="fw-bold d-flex align-items-center gap-2 mb-4">
                                    <i class="ki-duotone ki-key-square fs-2 text-primary"></i>
                                    Mã dự phòng (Recovery Codes)
                                </h4>

                                @php
                                    $codes = json_decode(auth()->user()->two_factor_recovery_codes ?? '[]', true);
                                @endphp

                                @if ($codes)
                                    <div class="row g-3">
                                        @foreach ($codes as $code)
                                            <div class="col-6">
                                                <div class="p-3 bg-white rounded border text-center fw-bold fs-6"
                                                    style="font-family: 'Courier New', monospace;">
                                                    {{ $code }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="d-flex gap-3 mt-5 justify-content-center border-top pt-5">
                                        <a href="{{ route('auth.2fa.recovery.download') }}"
                                            class="btn btn-light-primary btn-animated">
                                            <i class="ki-duotone ki-download fs-2 me-2"></i>Tải xuống
                                        </a>

                                        <form method="POST" action="{{ route('auth.2fa.recovery.regenerate') }}">
                                            @csrf
                                            <button class="btn btn-warning btn-animated">
                                                <i class="ki-duotone ki-refresh fs-2 me-2"></i>Tạo lại mã
                                            </button>
                                        </form>
                                    </div>

                                    <div class="text-muted mt-3 text-center">
                                        Mỗi mã dùng **1 lần**. Khi dùng xong sẽ bị xóa.
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>

                </div>
            @else
                {{-- Header --}}
                <div class="mb-12">
                    <h1 class="fw-bolder fs-2hx mb-4 d-flex align-items-center gap-3">
                        <i class="ki-duotone ki-shield-tick fs-1 text-primary floating-icon"></i>
                        Xác thực hai bước (2FA)
                    </h1>
                    <div class="text-gray-600 fs-5">
                        Tăng cường bảo mật tài khoản bằng mã xác thực thay đổi mỗi 30 giây.
                    </div>
                </div>

                {{-- Hero Banner --}}
                <div
                    class="alert bg-light-primary border border-primary rounded-3 p-7 mb-12 d-flex align-items-center position-relative overflow-hidden">
                    <i class="ki-duotone ki-shield-search fs-3hx text-primary floating-icon me-6"></i>

                    <div>
                        <div class="fw-bold fs-2 text-primary mb-2">Bảo mật nâng cao cho tài khoản</div>
                        <div class="text-gray-700 fs-5">
                            Ngay cả khi ai đó biết mật khẩu của bạn, họ vẫn không thể đăng nhập nếu không có mã từ Google
                            Authenticator.
                        </div>
                    </div>
                </div>
                <div class="row gy-10">

                    <!-- Main content -->
                    <div class="col-xl-7">

                        {{-- @if ($errors->has('code'))
                            <div class="alert alert-danger d-flex align-items-center mb-6 glow-box">
                                <i class="ki-duotone ki-cross-circle fs-1 me-3"></i>
                                <div>{{ $errors->first('code') }}</div>
                            </div>
                        @endif --}}

                        <div class="card shadow-sm border-0">
                            <div class="card-header py-5">
                                <h3 class="card-title fw-bold fs-2 d-flex align-items-center gap-2">
                                    <i class="ki-duotone ki-lock fs-2 text-primary floating-icon"></i>
                                    Bật Google Authenticator
                                </h3>
                            </div>

                            <div class="card-body py-10 px-9">

                                {{-- Steps --}}
                                <div class="mb-10">
                                    <h4 class="fw-bold mb-4">Các bước thực hiện</h4>

                                    @php
                                        $steps = [
                                            'Cài ứng dụng Google Authenticator (iOS/Android).',
                                            'Quét mã QR hoặc nhập mã bí mật.',
                                            'Nhập mã 6 số để kích hoạt.',
                                        ];
                                    @endphp

                                    @foreach ($steps as $i => $step)
                                        <div class="d-flex align-items-start mb-4">
                                            <span class="badge badge-circle badge-primary me-4">{{ $i + 1 }}</span>
                                            <div>{{ $step }}</div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- QR Code --}}
                                <div class="text-center mb-10">
                                    <div class="p-5 border rounded bg-white d-inline-block shadow-sm qr-pulse">
                                        {!! $qrSvg !!}
                                    </div>
                                </div>

                                {{-- Secret Key --}}
                                <div class="mb-10">
                                    <label class="fw-semibold form-label">
                                        <i class="ki-duotone ki-key fs-2 text-primary me-2 floating-icon"></i>
                                        Mã bí mật (backup)
                                    </label>

                                    <div class="input-group input-group-lg glow-box">
                                        <input type="text" class="form-control" value="{{ $secret }}" readonly>
                                        <button type="button" class="btn btn-light-primary"
                                            onclick="navigator.clipboard.writeText('{{ $secret }}')">
                                            <i class="ki-duotone ki-copy fs-2"></i> Sao chép
                                        </button>
                                    </div>

                                    <div class="text-muted mt-2">Giữ mã này an toàn — dùng khi chuyển điện thoại.</div>
                                </div>

                                {{-- Form --}}
                                <form method="POST" action="{{ route('auth.2fa.enable') }}" class="mt-8">
                                    @csrf

                                    <input type="hidden" name="secret" value="{{ $secret }}">

                                    <label class="form-label fw-bold fs-6">Nhập mã 6 số</label>

                                    <input type="text" name="code" maxlength="6"
                                        class="form-control form-control-lg form-control-solid fs-3 text-center tracking-widest mb-6"
                                        placeholder="••••••" required>

                                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3 btn-animated">
                                        <i class="ki-duotone ki-shield-tick fs-2 me-2"></i>
                                        Kích hoạt bảo mật 2 bước
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Side info panel -->
                    <div class="col-xl-5">

                        <div class="card shadow-sm border-0 mb-7">
                            <div class="card-body p-7">
                                <h4 class="fw-bold mb-5 d-flex align-items-center gap-2">
                                    <i class="ki-duotone ki-security-user fs-2 text-primary floating-icon"></i>
                                    Lợi ích khi bật 2FA
                                </h4>

                                <div class="d-flex gap-3 mb-4">
                                    <i class="ki-duotone ki-check-circle fs-2 text-success floating-icon"></i>
                                    <div>Tài khoản gần như không thể bị xâm nhập.</div>
                                </div>

                                <div class="d-flex gap-3 mb-4">
                                    <i class="ki-duotone ki-check-circle fs-2 text-success floating-icon"></i>
                                    <div>Mã thay đổi liên tục mỗi 30 giây.</div>
                                </div>

                                <div class="d-flex gap-3">
                                    <i class="ki-duotone ki-check-circle fs-2 text-success floating-icon"></i>
                                    <div>Dễ dùng và hoàn toàn miễn phí.</div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0">
                            <div class="card-body p-7">
                                <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
                                    <i class="ki-duotone ki-question fs-2 text-primary"></i>
                                    FAQ
                                </h4>

                                <div class="mb-4">
                                    <div class="fw-semibold">Mất điện thoại?</div>
                                    <div class="text-muted">Dùng mã backup hoặc liên hệ hỗ trợ.</div>
                                </div>

                                <div class="mb-4">
                                    <div class="fw-semibold">Đổi sang thiết bị mới?</div>
                                    <div class="text-muted">Tắt 2FA rồi bật lại bằng thiết bị mới.</div>
                                </div>

                                <div>
                                    <div class="fw-semibold">App nào hỗ trợ?</div>
                                    <div class="text-muted">Google Authenticator, Microsoft Authenticator, Authy…</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            @endif

        </div>
    </div>
@endsection
