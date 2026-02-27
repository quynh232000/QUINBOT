@php
    $menus = config('constants.menus._register');
    // dd($menus);
    // die();
    $currentRouteName = \Route::currentRouteName();
@endphp


<!--end::Sidebar-->
<!--begin::sidebar-panel-->
<div id="kt_app_sidebar_panel" class="app-sidebar-panel" style="margin:0; border-radius:0" data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar-panel" data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_app_sidebar_panel_mobile_toggle">

    <!--begin::Sidebar panel body-->
    <div class="hover-scroll-y scroll-ps m-2" id="kt_sidebar_panel_body" data-kt-scroll="true"
        data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header"
        data-kt-scroll-wrappers="#kt_sidebar_panel_body" data-kt-scroll-offset="5px">
        <!--begin::Sidebar secondary menu-->
        <div class="app-sidebar-secondary-menu menu menu-sub-indention menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-500 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 py-2"
            id="kt_app_sidebar_secondary_menu" data-kt-menu="true">

            @foreach ($menus as $menu)
                <x-sidebar.menu-item :item="$menu"  :currentRouteName="$currentRouteName" />
            @endforeach

            <!--begin::Footer-->
            <div class="d-flex flex-column flex-center pb-4 pt-lg-8 border-top mt-4" id="kt_app_sidebar_footer">
                <!--begin::User menu-->
                <div class="cursor-pointer symbol symbol-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                    data-kt-attach="parent" data-kt-menu-placement="right-end">
                    <img src="{{auth()->user()->avatar}}" alt="user" />
                </div>
                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="{{auth()->user()->avatar}}" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">{{auth()->user()->full_name}}
                                    <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                                </div>
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{auth()->user()->email}}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="account/overview.html" class="menu-link px-5">My Profile</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="apps/projects/list.html" class="menu-link px-5">
                            <span class="menu-text">My Projects</span>
                            <span class="menu-badge">
                                <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
                            </span>
                        </a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                        data-kt-menu-placement="left-end" data-kt-menu-offset="-15px, 0">
                        <a href="#" class="menu-link px-5">
                            <span class="menu-title">My Subscription</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/referrals.html" class="menu-link px-5">Referrals</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/billing.html" class="menu-link px-5">Billing</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/statements.html" class="menu-link px-5">Payments</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/statements.html" class="menu-link d-flex flex-stack px-5">Statements
                                    <span class="ms-2 lh-0" data-bs-toggle="tooltip" title="View your statements">
                                        <i class="ki-outline ki-information-5 fs-5"></i>
                                    </span></a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3">
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1"
                                            checked="checked" name="notifications" />
                                        <span class="form-check-label text-muted fs-7">Notifications</span>
                                    </label>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="account/statements.html" class="menu-link px-5">My Statements</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                        <a href="#" class="menu-link px-5">
                            <span class="menu-title position-relative">Mode
                                <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                    <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                                    <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                                </span></span>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                            data-kt-menu="true" data-kt-element="theme-mode-menu">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3 my-0">
                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                    data-kt-value="light">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="ki-outline ki-night-day fs-2"></i>
                                    </span>
                                    <span class="menu-title">Light</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3 my-0">
                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                    data-kt-value="dark">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="ki-outline ki-moon fs-2"></i>
                                    </span>
                                    <span class="menu-title">Dark</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3 my-0">
                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                    data-kt-value="system">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="ki-outline ki-screen fs-2"></i>
                                    </span>
                                    <span class="menu-title">System</span>
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                        data-kt-menu-placement="left-start" data-kt-menu-offset="0, 0">
                        <a href="#" class="menu-link px-5">
                            <span class="menu-title position-relative">Language
                                <span
                                    class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                                    <img class="w-15px h-15px rounded-1 ms-2"
                                        src="{{asset('assets/media/flags/united-states.svg')}}" alt="" /></span></span>
                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/settings.html" class="menu-link d-flex px-5 active">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{asset('assets/media/flags/united-states.svg')}}"
                                            alt="" />
                                    </span>English</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/settings.html" class="menu-link d-flex px-5">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{asset('assets/media/flags/spain.svg')}}" alt="" />
                                    </span>Spanish</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/settings.html" class="menu-link d-flex px-5">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{asset('assets/media/flags/germany.svg')}}" alt="" />
                                    </span>German</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/settings.html" class="menu-link d-flex px-5">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{asset('assets/media/flags/japan.svg')}}" alt="" />
                                    </span>Japanese</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="account/settings.html" class="menu-link d-flex px-5">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1" src="{{asset('assets/media/flags/france.svg')}}" alt="" />
                                    </span>French</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu sub-->
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5 my-1">
                        <a href="account/settings.html" class="menu-link px-5">Account Settings</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="{{route('auth.logout')}}" class="menu-link px-5">Sign Out</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
            </div>
            <!--end::Footer-->


        </div>
        <!--end::Sidebar secondary menu-->
    </div>
    <!--end::Sidebar panel body-->
</div>
