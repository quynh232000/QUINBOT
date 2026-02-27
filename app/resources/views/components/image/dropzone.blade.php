@props([
    'id',
    'name',
    'multiple'      => false,
    'maxSize'       => 2,
    'acceptedFiles' => 'image/*',
    'files'         => [],
    'params'        => null
])

@once
    <link rel="stylesheet" href="{{ url('assets/plugins/admin-lte/plugins/dropzone/min/dropzone.min.css') }}">
    <style>
        .custom-dropzone {
            border: 2px dashed #ced4da;
            border-radius: .75rem;
            background-color: #f8f9fa;
            padding: 1rem;
            transition: border-color .2s;
        }

        .custom-dropzone:hover {
            border-color: #80bdff;
        }

        .dz-message {
            grid-column: 1 / -1;
            text-align: center;
            /* padding: 2rem 1rem;
            border: 2px dashed #e9ecef;
            border-radius: .5rem;
            background: #fff; */
            font-size: .95rem;
            color: #6c757d;
        }

        .dz-preview {
            margin: 0 !important;
        }

        .dz-preview .card {
            overflow: hidden;
            border-radius: .5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            transition: transform .15s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .dz-preview .card:hover {
            transform: scale(1.02);
        }

        .dz-preview img {
            height: 160px;
            width: 100%;
            object-fit: cover;
        }

        .dz-fallback-icon {
            display: none;
            height: 160px;
            align-items: center;
            justify-content: center;
            background: #f1f3f5;
            color: #adb5bd;
            font-size: 2rem;
            width: 100%;
        }

        .dz-error .dz-thumb {
            display: none !important;
        }

        .dz-error .dz-fallback-icon {
            display: flex !important;
        }

        small[data-dz-errormessage] {
            font-size: 12px;
            color: #dc3545;
            display: block;
            text-align: center;
            margin-top: .25rem;
        }

        .dz-remove-btn {
            position: absolute;
            top: .5rem;
            right: .5rem;
            z-index: 10;
            border-radius: 50%;
            width: 1.5rem;
            height: 1.5rem;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dropzone .dz-preview.dz-image-preview {
            background: none;
        }
        .dz-preview .card{
            height: fit-content !important;
        }
        .p-1.text-truncate.small {
            min-height: 48px !important;
        }
    </style>
@endonce

<div>
    {{-- Template preview --}}
    <div id="{{ $id }}_template" hidden>
        <div class="dz-preview dz-file-preview p-2 {{ $params['preview'] ?? 'col-6 col-md-4 col-lg-3' }}">
            <div class="card shadow-sm border-0 mb-3 h-100">
                <div class="position-relative">
                    <img data-dz-thumbnail class="card-img-top dz-thumb" style="object-fit: cover" alt="preview">
                    <div class="dz-fallback-icon d-none align-items-center justify-content-center bg-light text-secondary">
                        <i class="fa fa-image fa-2x"></i>
                    </div>
                    <button data-dz-remove type="button" class="btn btn-sm btn-danger dz-remove-btn">
                        <i class="fa fa-times"></i>
                    </button>
                    
                </div>
                <div class="p-1 text-truncate small">
                    <span data-dz-name></span>
                    <small data-dz-errormessage></small>
                </div>
            </div>
        </div>
    </div>

    {{-- Dropzone wrapper --}}
    <div class="{{ $params['group'] ?? 'form-group' }}">
        <div class="dropzone custom-dropzone row {{$multiple ? '': ' d-flex justify-content-center'}}"
             id="{{ $id }}"
             data-max-size="{{ $maxSize }}"
             data-accepted="{{ $acceptedFiles }}"
             data-name="{{ $name }}"
             @if ($multiple) data-multiple @endif
             @if ($files) data-existing='@json($files)' @endif>

            <input type="file"
                   id="{{ $id }}_input"
                   name="{{ $name }}{{ $multiple ? '[]' : '' }}"
                   {{ $multiple ? 'multiple' : '' }} hidden>

            <div class="dz-default dz-message col-12 d-flex flex-column justify-content-center align-items-center">
                <i class="fa fa-cloud-upload-alt fa-2x mb-2 text-primary"></i>
                <span>Kéo thả hoặc bấm để chọn ảnh</span>
            </div>
        </div>
    </div>
</div>

@once
    @section('scripts')
        <script>
            Dropzone.autoDiscover = false;
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.dropzone').forEach(function(el) {
                    const id = el.id;
                    const templateEl = document.querySelector(`#${id}_template`);
                    if (!templateEl) return;

                    const template = templateEl.innerHTML;
                    templateEl.remove();

                    const fileInput = el.querySelector("input[type=file]");
                    const maxSize = parseInt(el.getAttribute("data-max-size")) || 2;
                    const accepted = el.getAttribute("data-accepted") || "image/*";
                    const allowMultiple = el.hasAttribute("data-multiple");
                    const inputName = el.dataset.name;

                    let dz = new Dropzone(`#${id}`, {
                        url: "#",
                        paramName       : fileInput.name,
                        maxFilesize     : maxSize,
                        acceptedFiles   : accepted,
                        addRemoveLinks  : false,
                        previewTemplate : template,
                        autoProcessQueue: false,
                        uploadMultiple  : allowMultiple,
                        parallelUploads : allowMultiple ? 10 : 1,
                        maxFiles        : allowMultiple ? null : 1,
                        init: function() {
                            let dataTransfer        = new DataTransfer();
                            let dzInstance          = this;

                            dzInstance.on("error", function(file, errorMessage) {
                                let errorElement    = file.previewElement.querySelector("[data-dz-errormessage]");
                                if (errorMessage.includes("File is too big")) {
                                    errorElement.textContent = "Ảnh giới hạn " + maxSize + "MB.";
                                } else if (errorMessage.includes("You can't upload files of this type")) {
                                    errorElement.textContent = "Định dạng không hợp lệ!";
                                } else {
                                    errorElement.textContent = errorMessage;
                                }
                            });

                            dzInstance.on("addedfile", function(file) {
                                if (!allowMultiple) {
                                    // Xóa file cũ nếu có
                                    if (dzInstance.files[1] != null) {
                                        dzInstance.removeFile(dzInstance.files[0]);
                                    }

                                    // Ẩn message mặc định
                                    const defaultMessage = dzInstance.element.querySelector(".dz-message");
                                    if (defaultMessage) defaultMessage.style.setProperty("display", "none", "important");
                                
                                }

                                if (!file.existing) {
                                    dataTransfer.items.add(file);
                                    fileInput.files = dataTransfer.files;
                                }
                            });

                            dzInstance.on("removedfile", function(file) {
                                if (!allowMultiple) {
                                    const defaultMessage = dzInstance.element.querySelector(".dz-message");
                                    if (defaultMessage && dzInstance.files.length === 0) {
                                        defaultMessage.style.setProperty("display", "flex", "important");
                                        defaultMessage.style.setProperty("justify-content", "center", "important");
                                        defaultMessage.style.setProperty("align-items", "center", "important");
                                        defaultMessage.style.setProperty("flex-direction", "column", "important");
                                    }
                                }

                                if (file.existing) {
                                    let input = document.createElement("input");
                                    input.type = "hidden";

                                    let normalized = inputName.replace(/\[|\]/g, "_");
                                    normalized = normalized.replace(/_+/g, "_").replace(/^_|_$/g, "");
                                    input.name = normalized + "_delete[]";

                                    input.value = file.existing_id || file.name;
                                    dzInstance.element.closest("form").appendChild(input);
                                } else {
                                    let newFiles = Array.from(dataTransfer.files).filter(f => f !== file);
                                    dataTransfer = new DataTransfer();
                                    newFiles.forEach(f => dataTransfer.items.add(f));
                                    fileInput.files = dataTransfer.files;
                                }
                            });

                            // Render ảnh cũ (edit)
                            if (el.hasAttribute("data-existing")) {
                                let existingFiles   = JSON.parse(el.getAttribute("data-existing"));
                                existingFiles.forEach(function(file, idx) {
                                    let mockFile    = {
                                                        name: file.name || file.image || file.url || ("Ảnh " + (idx + 1)),
                                                        title: file.name || file.image || file.url || ("Ảnh " + (idx + 1)),
                                                        size: file.size || 123456,
                                                        existing: true,
                                                        existing_id: file.id || null
                                                    };
                                    dzInstance.emit("addedfile", mockFile);
                                    dzInstance.emit("thumbnail", mockFile, file.url || file.image || '');
                                    dzInstance.emit("complete", mockFile);
                                    dzInstance.files.push(mockFile);
                                });
                            }

                            // xử lý khi ảnh load lỗi
                            dzInstance.on("thumbnail", function(file, dataUrl) {
                                if (file.previewElement) {
                                    let img         = file.previewElement.querySelector("img");
                                    if (img) {
                                        img.onerror = function() {
                                            img.style.display   = "none";
                                            let fallback        = file.previewElement.querySelector(".dz-fallback-icon");
                                            if (fallback) fallback.style.display = "flex";
                                        };
                                    }
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
@endonce
