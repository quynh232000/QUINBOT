<div class="row g-3 mb-9">
    <!--begin::Col-->
    <div class="col-md-6">
        <!--begin::Google link=-->

        <a href="{{ route('auth.redirect', ['provider' => 'google']) }}"
            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100"
            style="color:white">
            <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}"
                class="h-15px me-3" />{{__('message.sign_in_with_google')}}</a>
        <!--end::Google link=-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-md-6">
        <!--begin::Google link=-->
        <a href="{{ route('auth.redirect', ['provider' => 'github']) }}"
            class="btn btn-flex btn-outline btn-text-gray-700  flex-center text-nowrap w-100"
            style="background-color: #161616;color:white">
            <img alt="Logo" src="{{ asset('assets\media\auth\github.jpg') }}"
                class="theme-light-show h-15px me-3" />
            <img alt="Logo" src="{{ asset('assets\media\auth\github.jpg') }}"
                class="theme-dark-show h-15px me-3" />
            {{__('message.sign_in_with_github')}}
        </a>



        <!--end::Google link=-->
    </div>
    <!--end::Col-->
</div>
