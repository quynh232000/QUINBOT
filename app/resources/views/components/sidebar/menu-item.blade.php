@props(['item', 'currentRouteName'])

@php
    $hasSub = isset($item['sub']);
    $routeName = $item['route'] ?? null;
    $method = 'GET';
    $show = false;
    $isActive = false;
    if (!$routeName || !$hasSub) {
        // ⚠️ Trường hợp KHÔNG có route và KHÔNG có sub → vẫn hiển thị
        $show = true;
        if (Str::startsWith($currentRouteName, $item['name_route'] ?? false)) {
            $isActive = true;
        }
        $isActive = $isActive || request()->routeIs($routeName);
    }

    // Trường hợp có route và KHÔNG có sub: kiểm tra quyền
    if ($routeName && !$hasSub) {
        $show = auth()->check() && auth()->user()->hasPermission($routeName, $method);
        $isActive = $isActive || request()->routeIs($routeName);
    }
    // Trường hợp có sub: hiển thị nếu ít nhất 1 sub có quyền
    if ($hasSub && isset($item['sub'])) {
        foreach ($item['sub'] as $subItem) {
            $subRoute = $subItem['route'] ?? null;
            if ($subRoute && auth()->check() && auth()->user()->hasPermission($subRoute, $method)) {
                $show = true;
            }
            // Kiểm tra sub route active
            if ($subRoute && request()->routeIs($subRoute)) {
                $isActive = true;
            }
        }
    }
    // hover show
@endphp
@if ($show)
    <div data-kt-menu-trigger="click"
        class="menu-item {{ $hasSub ? 'menu-accordion ' . ($isActive ? 'show' : '') : '' }}">
        @if (isset($item['route']) && !$hasSub)
            <a href="{{ route($item['route']) }}" class="menu-link {{ $isActive ? 'active' : '' }}">
                <span class="menu-bullet">
                    {{-- <span class="bullet bullet-dot"></span> --}}
                    @if (isset($item['icon']))
                        <span class="menu-icon">
                            <i class="{{ $item['icon'] }} fs-2"></i>
                        </span>
                    @else
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                    @endif
                </span>
                <span class="menu-title">{{ $item['title'] }}</span>
            </a>
        @else
            <span class="menu-link">
                @if (isset($item['icon']))
                    <span class="menu-icon">
                        <i class="{{ $item['icon'] }} fs-2"></i>
                    </span>
                @else
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                @endif
                <span class="menu-title">{{ $item['title'] }}</span>
                @if ($hasSub)
                    <span class="menu-arrow"></span>
                @endif
            </span>
        @endif

        @if ($hasSub)
            <div class="menu-sub menu-sub-accordion">
                @foreach ($item['sub'] as $subItem)
                    <x-sidebar.menu-item :item="$subItem" :currentRouteName="$currentRouteName" />
                @endforeach
            </div>
        @endif
    </div>
@endif
