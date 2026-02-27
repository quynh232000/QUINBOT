{{-- TOAST MESSAGE - PHIÊN BẢN ĐẸP, MỜ GRADIENT --}}
@if (session('error') || session('success') || session('warning') || session('info'))
    <style>
        #toast-container {
            z-index: 9999;
        }

        .modern-toast {
            min-width: 320px;
            max-width: 420px;
            border-radius: 16px;
            overflow: hidden;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            animation: slideInRight 0.5s cubic-bezier(0.22, 0.61, 0.36, 1) forwards;
            opacity: 0;
            transform: translateX(100%);
        }

        .modern-toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        /* Gradient background theo loại */
        .toast-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.85), rgba(22, 163, 74, 0.9));
            color: white;
        }

        .toast-error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.85), rgba(220, 38, 38, 0.9));
            color: white;
        }

        .toast-warning {
            background: linear-gradient(135deg, rgba(251, 146, 60, 0.85), rgba(251, 113, 133, 0.9));
            color: white;
        }

        .toast-info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.85), rgba(37, 99, 235, 0.9));
            color: white;
        }

        .toast-icon {
            font-size: 28px;
            animation: bounce 2s infinite;
            margin-right: 14px; 
            margin-bottom: 5px
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        @keyframes slideInRight {
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .toast-body {
            font-weight: 400;
            font-size: 15px;
            line-height: 1.5;
            word-wrap: break-word;
        }

        .btn-close-white {
            filter: brightness(0) invert(1);
            opacity: 0.9;
        }
    </style>

    <div id="toast-container" class="position-fixed bottom-0 end-0 p-4" style="z-index: 9999; pointer-events: none;">
        <div class="d-flex flex-column gap-3" style="pointer-events: auto;">
            {{-- Success Toast --}}
            @foreach (['success', 'error', 'warning', 'info'] as $type)
                @if (session($type))
                    @php
                        $icon = match ($type) {
                            'success' => 'fa-circle-check',
                            'error' => 'fa-circle-xmark',
                            'warning' => 'fa-triangle-exclamation',
                            'info' => 'fa-circle-info',
                        };
                        $class = "toast-{$type}";
                    @endphp

                    <div class="modern-toast {{ $class }} text-white" role="alert">
                        <div class="d-flex align-items-center px-4 py-2">
                            <span class="toast-icon flex-shrink-0">
                                <i class="fa-regular {{ $icon }} fa-beat text-white"></i>
                            </span>
                            <div class="toast-body flex-grow-1 me-3">
                                {{ session($type) }}
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- AUTO SHOW + ANIMATION --}}
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toasts = container.querySelectorAll('.modern-toast');

        toasts.forEach((toastEl, index) => {
            // Thêm class show để chạy animation CSS
            setTimeout(() => {
                toastEl?.classList.add('show');
            }, index * 300);

            // Tạo Bootstrap Toast instance
            const bsToast = new bootstrap.Toast(toastEl, {
                delay: 4000,
                animation: true
            });

            // Hiển thị toast
            bsToast.show();

            // QUAN TRỌNG: Chỉ xóa element KHI toast đã thực sự ẩn xong và vẫn còn tồn tại
            toastEl.addEventListener('hidden.bs.toast', function e() {
                // Kiểm tra xem element còn trong DOM không trước khi remove
                if (toastEl.isConnected) {
                    toastEl.remove();
                }
                // Xóa listener để tránh memory leak (tùy chọn nhưng nên có)
                toastEl.removeEventListener('hidden.bs.toast', e);
            });

            // Nếu người dùng bấm close thủ công, cũng cần xử lý an toàn
            toastEl.querySelector('.btn-close')?.addEventListener('click', () => {
                bsToast.hide(); // Bootstrap sẽ tự handle hide và trigger hidden.bs.toast
            });
        });

        // Bonus: Tự động dọn dẹp container nếu không còn toast nào
        const observer = new MutationObserver(() => {
            if (container.children.length === 0) {
                // container.remove(); // hoặc để lại cũng được
            }
        });
        observer.observe(container, { childList: true });
    });
</script>
@endif
