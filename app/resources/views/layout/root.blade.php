<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') | {{ config('app.name') }}</title>

    {{-- SEO & Meta --}}
    <meta name="description" content="Admin Dashboard created by {{ config('constants.info.auth.name') }}" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/media/logos/logo-icon.png') }}">

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome-6-pro/css/all.min.css') }}">

    {{-- Global Vendor Styles (Metronic/Bootstrap) --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    
    {{-- Custom Global CSS --}}
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    
    <style>
        img { object-fit: cover; }
    </style>

    {{-- Page Specific Styles --}}
    @stack('css')
    
    {{-- Theme Mode Script (Nên chạy ngay để tránh bị nháy trắng trang) --}}
    <script>
        let themeMode = localStorage.getItem("data-bs-theme") || "light";
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    </script>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">

    {{-- Main Content --}}
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        @yield('root')
    </div>

    {{-- Global Components --}}
    <x-admin.toast-message />

    {{-- Scripts --}}
    <script>var hostUrl = "{{ asset('assets/') }}";</script>
    
    {{-- Core JS (Phải load theo đúng thứ tự này) --}}
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    
    {{-- App Functions --}}
    <script src="{{ asset('assets/js/admin/function.js') }}"></script>
    <script src="{{ asset('assets/js/admin/admin-function.js') }}"></script>

    {{-- Page Specific Scripts --}}
    @stack('js')

</body>
</html>