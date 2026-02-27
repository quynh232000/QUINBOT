<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- import bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="w-full lg:max-w-2xl ">
        <div class="card w-full lg:w-1/2 bg-white dark:bg-[#1b1b18] shadow-md rounded-lg">
            <div class="card-body">
                {{-- <h5 class="card-title">QUINBOT Control Center</h5>
                <p>Bấm nút để bắt đầu tìm kiếm nội dung trending từ Reddit/Hacker News.</p> --}}

                <form action="{{ route('scan.trends') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary m-auto">
                         Scan
                    </button>
                </form>

                @if (session('status'))
                    <div class="alert alert-success mt-3">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</body>

</html>
