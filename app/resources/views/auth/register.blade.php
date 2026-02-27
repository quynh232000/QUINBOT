@extends('layout.auth')
@section('title', 'Register')
@section('main')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <div class="col-12">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <!--begin::Form-->
                <form class="form w-100" method="post"
                    action="{{ route($params['prefix'] . '.' . $params['controller'] . '.' . $params['action']) }}">
                    <!--begin::Heading-->
                    @csrf
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                        <!--end::Subtitle=-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Login options-->
                    <x-admin.login-with-google></x-admin.login-with-google>
                    <!--end::Login options-->
                    <!--begin::Separator-->
                    <div class="separator separator-content my-14">
                        <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                    </div>
                    <!--end::Separator-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Full name" name="full_name" value="{{old('full_name')}}" autocomplete="off"
                            class="form-control bg-transparent" />
                        <!--end::Email-->
                        @error('full_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Email" name="email" value="{{old('email')}}" autocomplete="off"
                            class="form-control bg-transparent" />
                        <!--end::Email-->
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-8" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control bg-transparent" type="password" value="{{old('password')}}" placeholder="Password"
                                    name="password" autocomplete="off" />
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                    <i class="ki-outline ki-eye-slash fs-2"></i>
                                    <i class="ki-outline ki-eye fs-2 d-none"></i>
                                </span>
                            </div>
                            <!--end::Input wrapper-->
                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <!--end::Wrapper-->
                        <!--begin::Hint-->
                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Accept-->
                    <div class="fv-row mb-8">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" value="1" />
                            <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">I Accept the
                                <a href="#" class="ms-1 link-primary">Terms</a></span>
                        </label>
                    </div>
                    <!--end::Accept-->
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Sign up</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                    <!--end::Submit button-->
                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                        <a href="{{ route('admin.auth.login') }}" class="link-primary fw-semibold">Sign in</a>
                    </div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Footer-->
            <div class="d-flex flex-stack px-lg-10">
                <!--begin::Languages-->
                <x-admin.language></x-admin.language>
                <!--end::Languages-->
                <!--begin::Links-->
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="pages/team.html" target="_blank">Terms</a>
                    <a href="pages/pricing/column.html" target="_blank">Plans</a>
                    <a href="pages/contact.html" target="_blank">Contact Us</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Card-->
    </div>
@endsection

@push('js2')
    <script src="{{ asset('assets/js/custom/authentication/sign-up/general.js') }}"></script>
@endpush
