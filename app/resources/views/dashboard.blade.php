@extends('layout.app')
@section('title', 'Trend')


@section('app')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">

            <div class="card-body py-4">
                <div class="w-full lg:max-w-2xl ">
                    <div class="card w-full lg:w-1/2 bg-white dark:bg-[#1b1b18] shadow-md rounded-lg">
                        <div class="card-body">
                            <h5 class="card-title">QUINBOT Control Center</h5>
                            <p>Bấm nút để bắt đầu tìm kiếm nội dung trending từ Reddit/Hacker News.</p>

                            <form action="{{ route('scan.trends') }}" method="POST" class="w-100">
                                @csrf
                                <div class="input-group input-group-solid mb-5 w-lg-50 m-auto">
                                    <span class="input-group-text">
                                        <i class="ki-duotone ki-magnifier fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>

                                    <input type="text" name="topic" class="form-control"
                                        placeholder="Nhập chủ đề muốn quét (ví dụ: AI News, Crypto, Cooking...)" required
                                        value="{{ old('topic') }}" />

                                    <button type="submit" class="btn btn-primary">
                                        Scan Trends
                                    </button>
                                </div>

                                @error('topic')
                                    <div class="text-danger mt-2 text-center">{{ $message }}</div>
                                @enderror
                            </form>

                            @if (session('status'))
                                <div class="alert alert-success mt-3">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
