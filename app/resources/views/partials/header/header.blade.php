<div id="kt_app_header" class="app-header d-flex align-items-stretch shadow-sm">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        
        <div class="d-flex align-items-stretch">
            <div class="d-flex flex-center px-5 me-5">
                <a href="/">
                    <img alt="Logo" src="{{asset('assets/media/logos/logo-new.png')}}" class="h-30px h-lg-35px" />
                </a>
            </div>
            <div class="d-flex flex-column justify-content-center me-3">
                <h1 class="text-gray-900 fw-bold fs-4 mb-0">@yield('title', 'Dashboard')</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-8 my-0 text-muted">
                    <li class="breadcrumb-item text-muted">QUIN-POS</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">{{ session('branch_name', 'Chi nhánh mặc định') }}</li>
                </ul>
            </div>
        </div>

        <div class="app-navbar flex-shrink-0 gap-2 gap-lg-4">
            
            <div class="app-navbar-item d-none d-lg-flex align-items-center">
                <div class="position-relative w-md-250px w-xl-300px">
                    <i class="ki-outline ki-magnifier fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-4"></i>
                    <input type="text" class="form-control form-control-solid ps-12 h-40px" name="search" value="" placeholder="Tìm kiếm nhanh..." />
                </div>
            </div>

            <div class="app-navbar-item">
                <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px position-relative" 
                     data-kt-menu-trigger="{default: 'click', lg: 'hover'}" 
                     data-kt-menu-attach="parent" 
                     data-kt-menu-placement="bottom-end">
                    
                    <i class="ki-outline ki-notification-on fs-1"></i>
                    
                    <span class="bullet bullet-dot bg-danger h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                </div>

                <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
                    <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{asset('assets/media/misc/menu-header-bg.jpg')}}')">
                        <h3 class="text-white fw-semibold px-9 mt-10 mb-6">Thông báo 
                        <span class="fs-8 opacity-75 ms-3">2 tin mới</span></h3>
                    </div>
                    <div class="scroll-y mh-325px my-5 px-8">
                        <div class="d-flex flex-stack py-4">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px me-4">
                                    <span class="symbol-label bg-light-primary">
                                        <i class="ki-outline ki-abstract-28 fs-2 text-primary"></i>
                                    </span>
                                </div>
                                <div class="mb-0 me-2">
                                    <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Đơn hàng mới #123</a>
                                    <div class="text-gray-500 fs-7">Vừa xong tại Bàn số 5</div>
                                </div>
                            </div>
                            <span class="badge badge-light fs-8">1 phút</span>
                        </div>
                    </div>
                    <div class="py-3 text-center border-top">
                        <a href="#" class="btn btn-color-gray-600 btn-active-color-primary">Xem tất cả <i class="ki-outline ki-arrow-right fs-5"></i></a>
                    </div>
                </div>
            </div>

            <div class="app-navbar-item" id="kt_header_user_menu_toggle">
                <div class="cursor-pointer symbol symbol-35px symbol-md-40px" 
                     data-kt-menu-trigger="{default: 'click', lg: 'hover'}" 
                     data-kt-menu-attach="parent" 
                     data-kt-menu-placement="bottom-end">
                    
                    <div class="d-flex align-items-center">
                        <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-3">
                            <span class="text-gray-900 fw-bold fs-7 lh-1 mb-1">{{ Auth::user()->name ?? 'Nhân viên' }}</span>
                            <span class="text-muted fw-semibold fs-8 lh-1 text-capitalize">{{ session('role', 'Vai trò') }}</span>
                        </div>
                        <img src="{{ Auth::user()->avatar_url ?? asset('assets/media/avatars/300-1.jpg') }}" 
                             class="rounded-3" style="width:40px; height:40px; object-fit:cover;" alt="user" />
                    </div>
                </div>

                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="{{ Auth::user()->avatar_url ?? asset('assets/media/avatars/300-1.jpg') }}" />
                            </div>
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5">
                                    {{ Auth::user()->name ?? 'Nhân viên' }}
                                    <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                                </div>
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email ?? 'email@domain.com'}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="separator my-2"></div>
                    <div class="menu-item px-5"><a href="#" class="menu-link px-5">Hồ sơ của tôi</a></div>
                    <div class="menu-item px-5"><a href="#" class="menu-link px-5">Chuyển chi nhánh</a></div>
                    <div class="separator my-2"></div>
                    <div class="menu-item px-5">
                        <form action="" method="POST" id="logout-form">
                            @csrf
                            <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit()" class="menu-link px-5 text-danger">Đăng xuất</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>