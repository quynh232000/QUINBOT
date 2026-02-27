@extends('layout.app')
@section('title', 'Danh sách bài viết đang thịnh hành')


@section('app')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span class="path1"></span><span
                                class="path2"></span></i>
                        <input type="text" data-kt-user-table-filter="search"
                            class="form-control form-control-solid w-250px ps-13" placeholder="Tìm kiếm trend..." />
                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                {{-- total --}}
                <div>
                    <span class="fs-6 fw-bold text-gray-700">Tổng số bài viết:</span>
                    <span class="fs-6 fw-bold text-primary ms-2">{{ number_format($trends->total()) }}</span>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_trends">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th>ID</th>
                                <th class="min-w-125px">Bài viết</th>
                                <th class="min-w-100px">Nguồn</th>
                                <th class="min-w-100px">Viral Score</th>
                                <th class="min-w-100px">Trạng thái</th>
                                <th class="min-w-100px">Ngày đăng</th>
                                <th class="text-end min-w-100px">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($trends as $trend)
                                <tr>
                                    <td>{{$trend->id}}</td>
                                    <td class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="{{ $trend->url_source }}" target="_blank">
                                                {{-- <div class="symbol-label">
                                                    <img src="{{ $trend->thumbnail_url ?? asset('assets/media/svg/files/blank-image.svg') }}"
                                                        alt="Thumbnail" class="w-100" />
                                                </div> --}}
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="{{ $trend->url_source }}" target="_blank"
                                                class="text-gray-800 text-hover-primary mb-1 fw-bold">
                                                {{ Str::limit($trend->title, 60) }}
                                            </a>
                                            <span class="text-muted fs-7">{{ $trend->post_type }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="badge badge-light-info fw-bold">{{ $trend->source }}</div>
                                        <div class="text-muted fs-7 italic">{{ $trend->source_type }}</div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-danger"><i
                                                    class="ki-duotone ki-heart fs-5 text-danger"></i>
                                                {{ number_format($trend->engagement_score) }}</span>
                                            <span class="text-muted fs-7">{{ $trend->comment_count }} comments</span>
                                        </div>
                                    </td>

                                    <td>
                                        @if ($trend->status == 'pending')
                                            <div class="badge badge-light-warning">Chờ duyệt</div>
                                        @elseif($trend->status == 'approved')
                                            <div class="badge badge-light-success">Đã duyệt</div>
                                        @else
                                            <div class="badge badge-light-danger">{{ $trend->status }}</div>
                                        @endif
                                    </td>

                                    <td>{{ $trend->published_at ? $trend->published_at->format('d/m/Y H:i') : 'N/A' }}</td>

                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route('trends.approve', $trend->id) }}" class="menu-link px-3 text-success">Duyệt</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 text-danger">Xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    {{ $trends->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
