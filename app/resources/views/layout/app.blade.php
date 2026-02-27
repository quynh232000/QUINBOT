@extends('layout.root')
@push('css')
    <style>
        .p-1.text-left.align-middle {
            padding: auto 10px !important;
        }

        .fixed-bottom-bar {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
        }

        .fixed-bottom-bar .btn {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 10px 18px;
        }

        .input-error {
            color: var(--bs-form-invalid-border-color);
            margin-top: 2px;
        }
    </style>
@endpush

@section('root')
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            @include('partials.header.header')

            <!--begin::Wrapper-->
            <div class="app-wrapper " id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @include('partials.sidebar.app')
                <!--end::sidebar-panel-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div style="padding:10px 30px 0 !important">
                    </div>
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">

                            <!--begin::Content container-->
                            @yield('app')
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        @include('include.footer.app_footer')
                        <!--end::Footer container-->
                    </div>
                    <!--end::Footer-->
                </div>

                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->
    <!--begin::Modals-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('assets/') }}";
    </script>

    {{-- script --}}
    @include('include.script.javascript')
@endsection

@push('js2')
    @once
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script>
            if ($('table.table-striped tbody tr')?.length === 0) {
                $('table.table-striped tbody').html('<tr><td colspan="100%" class="text-center">No data</td></tr>');
            }
        </script>
        <script src="{{ asset('assets/js/admin/admin.js') }}"></script>

    @endonce
@endpush
