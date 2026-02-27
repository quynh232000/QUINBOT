@php
    $module_name    = ''; // Thay bằng tên module thực tế của bạn
    $menus          = [
                        // --- trens ---
                        [
                            'title'         => __('message.blog'),
                            'icon'          => 'ki-chart-line-star',
                            'permission'    => 'trends_view',
                            'children'      => [
                                                ['title' => __('message.blogs_list'), 'route' => $module_name.'trends.index', 'permission' => 'trends_view'],
                                                ['title' => __('Danh sách kịch bản'), 'route' => $module_name.'video-project.index', 'permission' => 'trends_view'],
                                            ]
                        ],
                        
    ];

    $currentRoute = \Route::currentRouteName();
    $hasPermission = function($permission) { return true; }; // Thay bằng logic thực tế của bạn
@endphp

<style>
    /* Tinh chỉnh để Sidebar mượt hơn trong Dark Mode */
    [data-bs-theme="dark"] .app-sidebar-panel {
        background-color: #1e1e2d !important; /* Màu nền tối đặc trưng Metronic */
        border-right: 1px solid #2b2b40;
    }
    
    .menu-item .menu-link.active {
        background-color: var(--bs-light-primary) !important;
    }
    
    [data-bs-theme="dark"] .menu-item .menu-link.active {
        background-color: rgba(63, 66, 84, 0.35) !important;
    }

    .menu-link { transition: all 0.2s ease; }
</style>

<div id="kt_app_sidebar_panel" class="app-sidebar-panel shadow-sm border-end pt-4" 
    style="margin:0; border-radius:0;" 
    data-kt-drawer="true" data-kt-drawer-name="app-sidebar-panel" 
    data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true" data-kt-drawer-width="280px" 
    data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_app_sidebar_panel_mobile_toggle">

    {{-- <div class="d-flex flex-stack px-8 pt-10 mb-8">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-30px me-3">
                <div class="symbol-label bg-light-primary">
                    <i class="ki-outline ki-abstract-26 text-primary fs-4"></i>
                </div>
            </div>
            <span class="text-uppercase fs-7 fw-bold text-gray-800 ls-1 dark-inverted">QUIN-POS</span>
        </div>
    </div> --}}

    <div class="hover-scroll-y scroll-ps px-4" id="kt_sidebar_panel_body" data-kt-scroll="true"
        data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header"
        data-kt-scroll-wrappers="#kt_sidebar_panel_body" data-kt-scroll-offset="5px">
        
        <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true">
            
            @foreach ($menus as $menu)
                @if ($hasPermission($menu['permission']))
                    
                    @if (isset($menu['children']))
                        @php
                            $isParentActive = collect($menu['children'])->contains('route', $currentRoute);
                        @endphp
                        
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $isParentActive ? 'here show' : '' }} mb-1">
                            <span class="menu-link py-3">
                                <span class="menu-icon">
                                    <i class="ki-outline {{ $menu['icon'] }} fs-2"></i>
                                </span>
                                <span class="menu-title text-gray-700 fw-bold">{{ $menu['title'] }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            
                            <div class="menu-sub menu-sub-accordion">
                                @foreach ($menu['children'] as $child)
                                    @if ($hasPermission($child['permission']))
                                        <div class="menu-item">
                                            <a class="menu-link py-2 {{ $currentRoute == $child['route'] ? 'active' : '' }}" 
                                               href="{{ $child['route'] ? route($child['route']) : '#' }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title fs-7 text-gray-600 fw-bold">{{ $child['title'] }}</span>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    @else
                        <div class="menu-item mb-1">
                            <a class="menu-link py-3 {{ $currentRoute == $menu['route'] ? 'active' : '' }}" 
                               href="{{ $menu['route'] ? route($menu['route']) : '#' }}">
                                <span class="menu-icon">
                                    <i class="ki-outline {{ $menu['icon'] }} fs-2"></i>
                                </span>
                                <span class="menu-title text-gray-700 fw-bold">{{ $menu['title'] }}</span>
                            </a>
                        </div>
                    @endif

                @endif
            @endforeach

            <div class="separator separator-dashed my-6 opacity-25"></div>
            
            

        </div>
    </div>
</div>