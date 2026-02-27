@extends('layout.auth')
@section('title', 'Login')
@push('css')
    <style>
        /* Tổng thể Card */
        .modern-auth-card {
            background: rgba(255, 255, 255, 0.03) !important;
            /* Cực kỳ trong suốt */
            backdrop-filter: blur(25px) saturate(150%);
            -webkit-backdrop-filter: blur(25px) saturate(150%);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 2rem !important;
            /* Bo góc cực đại cho hiện đại */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Tinh chỉnh tiêu đề và text */


        /* Input Fields phong cách "Invisible" */
        .form-control-modern {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border-radius: 12px !important;
            transition: all 0.3s ease;
        }

        .form-control-modern:focus {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: #3e97ff !important;
            box-shadow: 0 0 15px rgba(62, 151, 255, 0.3);
        }

        /* Placeholder màu nhạt */
        .form-control-modern::placeholder {
            color: rgba(255, 255, 255, 0.3) !important;
        }

        /* Nút bấm hiệu ứng phát sáng */
        .btn-glow {
            background: #3e97ff !important;
            border: none;
            box-shadow: 0 0 20px rgba(62, 151, 255, 0.4);
            transition: all 0.3s ease;
        }

        .btn-glow:hover {
            box-shadow: 0 0 35px rgba(62, 151, 255, 0.6);
            transform: translateY(-2px);
        }

        /* Màu text mặc định cho nền tối */
        .text-muted-custom {
            color: rgba(255, 255, 255, 0.6) !important;
        }
    </style>
@endpush
@section('main')

    <div class="d-flex flex-column-fluid justify-content-center p-10">
        <div class="modern-auth-card d-flex flex-column align-items-stretch flex-center w-md-500px p-12">
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10">
                <form class="form w-100" id="admin-{{ $params['prefix'] }}-form" method="post">
                    @csrf
                    <div class="text-center mb-12">
                        <h1 class="auth-title fs-2qx mb-3">{{ __('message.sign_in_admin') }}</h1>
                        <div class="text-muted-custom fw-semibold fs-6">
                            {{ __('message.admin_panel_title') }}
                        </div>
                    </div>

                    <div class="mb-10 opacity-75 hover-opacity-100 transition-3ms">
                        <x-admin.login-with-google></x-admin.login-with-google>
                    </div>

                    <div class="separator separator-content my-10 border-secondary opacity-25">
                        <span class="w-125px text-muted-custom fw-semibold fs-7">{{ __('message.or_email') }}</span>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bold text-white fs-7 opacity-75">{{ __('message.email_system') }}</label>
                        <input type="text" placeholder="admin@brand.com" name="email" value="{{ old('email') }}"
                            class="form-control form-control-lg form-control-modern py-4" />
                    </div>

                    <div class="fv-row mb-3">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bold text-white fs-7 mb-0 opacity-75">{{ __('message.password') }}</label>
                            <a href="{{ route('auth.reset-password') }}" class="link-primary fs-7 fw-bold">{{ __('message.forgot_password') }}</a>
                        </div>
                        <input type="password" placeholder="••••••••" name="password"
                            class="form-control form-control-lg form-control-modern py-4" />
                    </div>
                    {{-- remember password --}}
                    <div class="fv-row mb-3">
                        <label class="form-check form-check-custom form-check-solid form-check-sm">
                            <input class="form-check-input" type="checkbox" name="remember" />
                            <span class="form-check-label text-white opacity-75">{{ __('message.remember_me') }}</span>12345
                        </label>
                    </div>

                    <div class="d-grid mb-10 mt-10">
                        <button type="submit" class="btn btn-glow btn-lg text-white fw-bolder">
                            <span class="indicator-label">{{ __('message.enter_system') }}</span>
                            <span class="indicator-progress">{{ __('message.verifying') }}...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>

                    <div class="text-muted-custom text-center fw-semibold fs-6">
                        {{ __('message.no_permission') }} <a href="{{ route('auth.register') }}" class="text-white fw-bold ml-2">{{ __('message.request_account') }}</a>
                    </div>
                </form>
            </div>

            <div class="d-flex flex-stack px-lg-10 mt-10 w-100">
                <x-admin.language></x-admin.language>
                <div class="d-flex fw-semibold text-muted-custom fs-7 gap-5">
                    <a href="#" class="text-hover-white">{{ __('message.privacy') }}</a>
                    <a href="#" class="text-hover-white">{{ __('message.support') }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js2')
    <script>
        $(document).ready(function() {

            handleAjaxFormSubmit('#admin-{{ $params['prefix'] }}-form', {
                url: "{{ route($params['prefix'] . '.' . $params['controller'] . '.post') }}",
                onSuccess: (res) => {
                    if (res?.data?.redirect_url) {
                        window.location.href = res.data?.redirect_url;
                    }
                    // remember me
                    if (res?.data?.remember_me) {
                        localStorage.setItem('remember_me', res.data.remember_me);
                    } else {
                        localStorage.removeItem('remember_me');
                    }

                },
                reloadOnSuccess: false
            });

            // Nếu có remember me trong localStorage, tự động điền vào form
            const rememberMeValue = localStorage.getItem('remember_me');
            if (rememberMeValue) {
                $('#admin-{{ $params['prefix'] }}-form').find('input[name="remember"]').prop('checked', true);
            }

            // $('#admin-{{ $params['prefix'] }}-form').submit(function(e) {
            //     e.preventDefault();
            //     $('.input-error').html('');
            //     const formEl = $(this)
            //     $(this).find('.indicator-label').hide()
            //     $(this).find('.indicator-progress').show()
            //     $(this).find(`button[type='submit']`).prop('disabled', true);
            //     $('.input-error').html('');
            //     $('.form-group row p-0 m-0 mb-2 input').removeClass('is-invalid');
            //     e.preventDefault();
            //     var formData = new FormData(this);
            //     $.ajax({
            //         type: 'POST',
            //         url: "{{ route($params['prefix'] . '.' . $params['controller'] . '.post') }}",
            //         data: formData,
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         cache: false,
            //         contentType: false,
            //         processData: false,
            //         success: (res) => {
            //             $(formEl).find('.indicator-label').show()
            //             $(formEl).find('.indicator-progress').hide()
            //             $(formEl).find(`button[type='submit']`).prop('disabled', false);
            //             Swal.fire({
            //                     text: res.message ??
            //                         "Form has been successfully submitted!",
            //                     icon: "success",
            //                     buttonsStyling: !1,
            //                     confirmButtonText: "Ok, got it!",
            //                     customClass: {
            //                         confirmButton: "btn btn-primary"
            //                     }
            //                 })
            //                 .then((function(e) {
            //                     window.location.reload()
            //                 }))

            //         },
            //         error: function(data) {
            //             console.log(data,data.responseJSON,data.responseJSON.errors.details ?? {});

            //             for (x in data.responseJSON.errors.details ?? {}) {
            //                 $(`[name="${x}"]`).parents('.form-group').find('.input-error').html(data
            //                     .responseJSON.errorsdetails[x]);
            //                 $(`[name="${x}"]`).parents('.form-group').find('.input-error').show();
            //                 $(`[name="${x}"]`).addClass('is-invalid');
            //             }

            //             $(formEl).find('.indicator-label').show()
            //             $(formEl).find('.indicator-progress').hide()
            //             $(formEl).find(`button[type='submit']`).prop('disabled', false);
            //             let errorMs = '<ul class="text-right text-start text-danger mt-3">';
            //             for (x in data.responseJSON.errors.details) {
            //                 errorMs += `<li><i class="">${data.responseJSON.errors.details[x]}</i></li>`
            //             }
            //             errorMs += '</ul>'
            //             if (data.status == 400) {
            //                 errorMs =
            //                     `<div class="text-danger mt-2"> ${ data.responseJSON.message ?? 'Error from server' }</div>`
            //             }
            //             Swal.fire({
            //                 html: "Sorry, something errors please try again: " +
            //                     errorMs,
            //                 icon: "error",
            //                 buttonsStyling: !1,
            //                 confirmButtonText: "Ok, got it!",
            //                 customClass: {
            //                     confirmButton: "btn btn-primary"
            //                 }
            //             })
            //         }
            //     });
            // });

        });
    </script>
@endpush
