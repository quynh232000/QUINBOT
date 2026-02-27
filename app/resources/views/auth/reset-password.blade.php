@extends('layout.auth')
@section('title', 'Login')
@section('main')

    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form"
                    data-kt-redirect-url="authentication/layouts/creative/new-password.html" action="#">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bolder mb-3">Forgot Password ?</h1>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Email" name="email" autocomplete="off"
                            class="form-control bg-transparent" />
                        <!--end::Email-->
                    </div>
                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="button" id="kt_password_reset_submit" class="btn btn-primary me-4">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Submit</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                        <a href="{{route('admin.auth.login')}}" class="btn btn-light">Cancel</a>
                    </div>
                    <!--end::Actions-->
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
