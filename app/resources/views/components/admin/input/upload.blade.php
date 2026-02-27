@props(['name', 'url', 'accept'])
@php
    $url        = $url ?? '';
    $name       = $name  ?? 'image';
    $accept       = $accept  ?? ".png, .jpg, .jpeg";
    $imageClass = 'image-placeholder-' . preg_replace('/[^a-z0-9_\-]/i', '-', $name);
    $imageUrl   = $url && trim($url) !== '' ? url($url) : asset('assets/media/svg/files/blank-image.svg');
@endphp
<div class="card-body text-center pt-0">
    <style>
        .{{ $imageClass }} {
            background-image: url("{{ $imageUrl }}");
        }

        [data-bs-theme="dark"] .{{ $imageClass }} {
            background-image: url("{{ $imageUrl }}");
        }
    </style>
    <div class="image-input image-input-empty image-input-outline {{ $imageClass }} mb-3"
        data-kt-image-input="true">
        <div class="image-input-wrapper w-150px h-150px"></div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
            <i class="ki-outline ki-pencil fs-7"></i>
            <input type="file" name="{{ $name ?? 'image' }}" accept="{{$accept}}" />
            <!--end::Inputs-->
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
            <i class="ki-outline ki-cross fs-2"></i>
        </span>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
            <i class="ki-outline ki-cross fs-2"></i>
        </span>
    </div>
    <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and
        *.jpeg image files are accepted</div>
</div>
