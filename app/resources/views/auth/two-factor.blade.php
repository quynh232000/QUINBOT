@extends('layout.auth')
@section('title', 'Login')
@section('main')

    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <!--begin::Form-->
                <form class="form w-100 mb-13" novalidate="novalidate" data-kt-redirect-url="index.html"
                    id="kt_sing_in_two_factor_form">
                    <!--begin::Icon-->
                    <div class="text-center mb-10">
                        <img alt="Logo" class="mh-125px" src="{{asset('assets/media/svg/misc/smartphone-2.svg')}}" />
                    </div>
                    <!--end::Icon-->
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-gray-900 mb-3">Two-Factor Verification</h1>
                        <!--end::Title-->
                        <!--begin::Sub-title-->
                        <div class="text-muted fw-semibold fs-5 mb-5">Enter the verification code we sent to</div>
                        <!--end::Sub-title-->
                        <!--begin::Mobile no-->
                        <div class="fw-bold text-gray-900 fs-3">******7859</div>
                        <!--end::Mobile no-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Section-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <div class="fw-bold text-start text-gray-900 fs-6 mb-1 ms-1">Type your 6 digit security code</div>
                        <!--end::Label-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-wrap flex-stack">
                            <input type="text" name="code_1" data-inputmask="'mask': '9', 'placeholder': ''"
                                maxlength="1"
                                class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                value="" />
                            <input type="text" name="code_2" data-inputmask="'mask': '9', 'placeholder': ''"
                                maxlength="1"
                                class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                value="" />
                            <input type="text" name="code_3" data-inputmask="'mask': '9', 'placeholder': ''"
                                maxlength="1"
                                class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                value="" />
                            <input type="text" name="code_4" data-inputmask="'mask': '9', 'placeholder': ''"
                                maxlength="1"
                                class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                value="" />
                            <input type="text" name="code_5" data-inputmask="'mask': '9', 'placeholder': ''"
                                maxlength="1"
                                class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                value="" />
                            <input type="text" name="code_6" data-inputmask="'mask': '9', 'placeholder': ''"
                                maxlength="1"
                                class="form-control bg-transparent h-60px w-60px fs-2qx text-center mx-1 my-2"
                                value="" />
                        </div>
                        <!--begin::Input group-->
                    </div>
                    <!--end::Section-->
                    <!--begin::Submit-->
                    <div class="d-flex flex-center">
                        <button type="button" id="kt_sing_in_two_factor_submit" class="btn btn-lg btn-primary fw-bold">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Submit-->
                </form>
                <!--end::Form-->
                <!--begin::Notice-->
                <div class="text-center fw-semibold fs-5">
                    <span class="text-muted me-1">Didn’t get the code ?</span>
                    <a href="#" class="link-primary fs-5 me-1">Resend</a>
                    <span class="text-muted me-1">or</span>
                    <a href="#" class="link-primary fs-5">Call Us</a>
                </div>
                <!--end::Notice-->
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
