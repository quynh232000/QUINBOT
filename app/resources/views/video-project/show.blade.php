@extends('layout.app')
@section('title', 'Chi tiết kịch bản')

@section('app')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card mb-6 mb-xl-9">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <div>
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $project->project_name }}</a>
                                        <div><i href="#"
                                                class="text-gray-900 text-hover-primary fs-5 mt-2 me-1">({{ $project->final_script['title_vi'] ?? '' }})</i>
                                        </div>
                                    </div>
                                    <span class="badge badge-light-success fw-bold  fs-8">Final Script Ready</span>
                                </div>
                                <div class="fs-6 fw-semibold text-gray-500">ID: #{{ $project->id }} | Created at:
                                    {{ $project->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="d-flex my-4">
                                <button class="btn btn-sm btn-bg-light btn-active-color-primary me-3">Export PDF</button>
                                <button class="btn btn-sm btn-primary">Start Rendering</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-6 g-xl-9">
            <div class="col-xl-8">
                <div class="card card-flush">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">Movie Scenes Sequence</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">Tổng cộng
                                {{ count($project->final_script['scenes']) }} phân cảnh</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="timeline-label">
                            @foreach ($project->final_script['scenes'] as $scene)
                                <div class="timeline-item">
                                    <div class="timeline-label fw-bold text-gray-800 fs-6  " style="">
                                        0{{ $scene['id'] }}</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-primary fs-1"></i>
                                    </div>
                                    <div class="timeline-content fw-mormal ps-3">
                                        <div class="fs-5 fw-bold text-gray-900 mb-2">{{ $scene['description'] }}</div>
                                        @foreach ($scene['characters'] as $char)
                                            <span class="badge badge-primary mb-1">{{ $char ?? '' }}</span>
                                        @endforeach
                                        <div class="bg-light-primary p-3 rounded mb-4">
                                            <div class="text-gray-700 italic">Action: {{ $scene['voiceover'] ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card card-flush mb-6">
                    <div class="card-header pt-7">
                        <h3 class="card-title fw-bold text-gray-900">Plot Twists</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($project->final_script['plot_twists'] as $twist)
                            <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-5">
                                <i class="ki-duotone ki-abstract-26 fs-1 text-warning me-5"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <div class="flex-grow-1">
                                    <a href="#"
                                        class="text-gray-900 fw-bold text-hover-primary fs-6">{{ $twist['description'] }}</a>
                                    <span class="text-muted d-block fw-semibold italic">Impact:
                                        {{ $twist['impact'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card card-flush">
                    <div class="card-header pt-7">
                        <h3 class="card-title fw-bold text-gray-900">Script Analysis</h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex flex-stack">
                            <span class="text-gray-500 fw-bold">Mood:</span>
                            <span class="text-gray-900 fw-bold">Thriller / Mystery</span>
                        </div>
                        <div class="separator separator-dashed my-4"></div>
                        <div class="d-flex flex-stack">
                            <span class="text-gray-500 fw-bold">Estimated Length:</span>
                            <span class="text-gray-900 fw-bold">~ 2:30 mins</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
