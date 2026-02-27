@extends('layout.app')
@section('title', 'Danh sách kịch bản video')


@section('app')
<div id="kt_app_content_container" class="app-container container-xxl">
    <div class="d-flex flex-stack mb-6">
        <h3 class="fw-bold my-2">Danh sách Video Projects 
        <span class="fs-6 text-gray-500 fw-semibold ms-1">({{ $projects->total() }})</span></h3>
        
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="" class="btn btn-sm fw-bold btn-primary">
                <i class="ki-duotone ki-plus fs-2"></i> Tạo Project mới
            </a>
        </div>
    </div>

    <div class="row g-6 g-xl-9">
        @foreach($projects as $project)
        <a href="{{route('video-project.show',[$project->id])}}" class="col-md-6 col-xl-4">
            <div class="card border-hover-primary">
                <div class="card-header border-0 pt-9">
                    <div class="card-title m-0">
                        <div class="symbol symbol-50px w-50px bg-light">
                            <img src="{{ asset('assets/media/svg/brand-logos/vimeo.svg') }}" alt="video-icon" class="p-3" />
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <span class="badge badge-light-{{ $project->status_color }} fw-bold me-auto px-4 py-3">
                            {{ $project->status_label }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-9">
                    <div class="overlay mb-5">
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" 
                             style="background-image:url('{{ $project->thumbnail ?? asset('assets/media/stock/600x400/img-1.jpg') }}')">
                        </div>
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                            <i class="ki-duotone ki-play fs-3x text-white"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                    </div>

                    <div class="fs-3 fw-bold text-gray-900 text-hover-primary lh-sm mb-2">
                        {{ $project->project_name }}
                    </div>
                    <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7">
                        {{ Str::limit($project->ai_model, 80) }}
                    </p>

                    <div class="d-flex flex-column mb-5">
                        <div class="d-flex flex-stack mb-2">
                            <span class="text-muted fw-semibold fs-7">Tiến độ render</span>
                            <span class="text-gray-900 fw-bold fs-7">{{ $project->progress_percent }}%</span>
                        </div>
                        <div class="progress h-6px w-100">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $project->progress_percent }}%"></div>
                        </div>
                    </div>

                    <div class="d-flex flex-stack flex-wraper">
                        <div class="d-flex align-items-center">
                            <div class="symbol-group symbol-hover">
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Nguồn: {{ $project->source }}">
                                    <span class="symbol-label bg-light-danger text-danger fw-bold text-uppercase">
                                        {{ substr($project->source, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-calendar-8 fs-2 me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></i>
                            <span class="text-gray-500 fw-bold">{{ $project->created_at->format('d M, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="d-flex flex-stack flex-wrap pt-10">
        <div class="fs-6 fw-semibold text-gray-700">Hiển thị từ {{ $projects->firstItem() }} đến {{ $projects->lastItem() }}</div>
        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection