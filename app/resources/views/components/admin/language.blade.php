


@php
    $languages = [
        'en' => ['name' => 'English', 'flag' => 'united-states.svg'],
        'vi' => ['name' => 'Tiếng Việt', 'flag' => 'vietnam.svg'],
        'fr' => ['name' => 'French', 'flag' => 'france.svg'],
        'jp' => ['name' => 'Japanese', 'flag' => 'japan.svg'],
        'es' => ['name' => 'Spanish', 'flag' => 'spain.svg'],
    ];

    // Giả sử ngôn ngữ hiện tại lấy từ App Locale
    $currentLocale = app()->getLocale();
    $currentLang = $languages[$currentLocale] ?? $languages['vi']; // Mặc định là tiếng Việt nếu không tìm thấy
@endphp
@push('css')
    <style>
        #kt_auth_lang_menus{
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1000;
            /* display: none; */
            background-color: gray;

        }
    </style>
@endpush


<div class="me-0 relative" style="position: relative">
    <button class="btn btn-flex btn-link btn_languge btn-color-white btn-active-color-primary rotate fs-base"
         data-kt-menu-placement="bottom-start">
        <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
            src="{{ asset('assets/media/flags/' . $currentLang['flag']) }}" alt="flag" />
        <span  class="me-1">{{ $currentLang['name'] }}</span>
        <i class="ki-outline ki-down fs-5 text-muted rotate-180 m-0"></i>
    </button>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7 glass-card border-0"
        data-kt-menu="true" id="kt_auth_lang_menus">

        @foreach ($languages as $code => $lang)
            <div class="menu-item px-3">
                <a href="{{ route('lang.switch', $code) }}"
                    class="menu-link d-flex px-5 {{ $currentLocale == $code ? 'active' : '' }}"
                    data-kt-lang="{{ $lang['name'] }}">
                    <span class="symbol symbol-20px me-4">
                        <img data-kt-element="lang-flag" class="rounded-1"
                            src="{{ asset('assets/media/flags/' . $lang['flag']) }}" alt="flag" />
                    </span>
                    <span data-kt-element="lang-name"
                        class="{{ $currentLocale == $code ? 'text-primary fw-bold' : 'text-white' }}">
                        {{ $lang['name'] }}
                    </span>
                </a>
            </div>
        @endforeach

    </div>
</div>
@push('js2')
    <script>
        // Mở menu khi click vào button
        $('.btn_languge').on('click', function(e) {
            e.preventDefault();
            $('#kt_auth_lang_menus' ).toggleClass('show');
        });

        // Đóng menu khi click ra ngoài
        $(document).on('click', function(e) {
            if (!$(e.target).closest('[data-kt-menu-placement], .menu').length) {
                $('.menu').removeClass('show');
            }
        });
        
    </script>
    
@endpush
