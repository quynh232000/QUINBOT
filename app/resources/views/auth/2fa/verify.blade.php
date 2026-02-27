@extends('layout.auth')
@section('title', 'Login')
@section('main')

    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">

            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">

                <!-- Logo + Title -->
                <div class="text-center mb-11">
                    <h2 class="fw-bold">Xác minh đăng nhập</h2>
                    <p class="text-muted" id="title-desc">
                        Nhập mã 6 số từ ứng dụng Google Authenticator
                    </p>
                </div>

                <!--===========  FORM MAIN  ===========-->
                <form class="form w-100" id="admin-{{ $params['prefix'] }}-form" method="post">
                    @csrf

                    <!-- Input: Authenticator OTP -->
                    <div id="otp-section" class="fv-row mb-8">
                        <input type="text" name="code" id="code"
                            class="form-control form-control-lg @error('code') is-invalid @enderror"
                            placeholder="Nhập mã Google Authenticator" maxlength="6">
                    </div>

                    <!-- Input: Recovery Code -->
                    <div id="recovery-section" class="fv-row mb-8 d-none">
                        <input type="text" name="recovery_code" id="recovery_code" class="form-control form-control-lg"
                            placeholder="Nhập mã dự phòng của bạn">
                    </div>

                    <!-- Hidden: mode -->
                    <input type="hidden" name="method" id="method" value="otp">

                    <div class="d-grid mb-10">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Xác minh</span>
                            <span class="indicator-progress">Đang xử lý...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>

                    <!-- Switch options -->
                    <div class="text-center mt-3">
                        <a href="javascript:void(0)" id="use-recovery" class="text-primary">
                            Sử dụng mã dự phòng
                        </a>
                        <a href="javascript:void(0)" id="use-otp" class="text-primary d-none">
                            Quay lại dùng Google Authenticator
                        </a>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('auth.login') }}">Quay lại đăng nhập</a>
                    </div>
                </form>
            </div>

            <div class="d-flex flex-stack px-lg-10">
                <x-admin.language></x-admin.language>
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="#">Terms</a>
                    <a href="#">Plans</a>
                    <a href="#">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js2')
    <script>
        $(document).ready(function() {


            // Toggle to Recovery mode
            $('#use-recovery').click(function() {
                $('#otp-section').addClass('d-none');
                $('#recovery-section').removeClass('d-none');

                $('#use-recovery').addClass('d-none');
                $('#use-otp').removeClass('d-none');

                $('#method').val('recovery');

                $('#title-desc').text('Nhập mã dự phòng của bạn để đăng nhập');
            });

            // Toggle back to OTP
            $('#use-otp').click(function() {
                $('#otp-section').removeClass('d-none');
                $('#recovery-section').addClass('d-none');

                $('#use-otp').addClass('d-none');
                $('#use-recovery').removeClass('d-none');

                $('#method').val('otp');

                $('#title-desc').text('Nhập mã 6 số từ Google Authenticator');
            });


            // HANDLE SUBMIT AJAX
            handleAjaxFormSubmit('#admin-{{ $params['prefix'] }}-form', {
                url: "{{ route($params['prefix'] . '.2fa.verify.post') }}",
                onSuccess: (res) => {
                    if (res?.data?.redirect_url) {
                        window.location.href = res.data.redirect_url;
                    }
                },
                reloadOnSuccess: false,
                debugger: false
            });
        });
    </script>
@endpush
