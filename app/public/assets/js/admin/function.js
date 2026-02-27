function handleAjaxFormSubmit(formSelector = null, options = {}) {
    const defaults = {
        url: '',                  // URL submit, nếu không có sẽ lấy từ form.action
        method: 'POST',
        reloadOnSuccess: true,    // Reload lại sau khi thành công
        resetForm: false,         // Reset form sau khi submit
        showAlert: true,          // Dùng Swal hay không
        onBeforeSend: null,       // Callback trước khi gửi
        onSuccess: null,          // Callback khi thành công
        onError: null,             // Callback khi lỗi
        debug: window.location.hostname === 'localhost' || location.hostname.includes('127.0.0.1'),              // 🧠 Bật log debug
        // add more data
        data: {}
    };

    const settings = Object.assign({}, defaults, options);

    if(!formSelector) {
        // call ajax without form
        $.ajax({
            type: settings.method,
            url: settings.url,
            data: settings.data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },  
            success: function (res) {
                if (settings.showAlert) {
                    Swal.fire({
                        text: res.message ?? "Thành công!",
                        icon: "success",
                        confirmButtonText: "OK",
                        buttonsStyling: false,
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        if (settings.reloadOnSuccess) window.location.reload();
                    });
                }
                if (typeof settings.onSuccess === 'function') {
                    settings.onSuccess(res, null);
                }
            },
            error: function (xhr) {
                const message       = xhr.responseJSON?.message ?? 'Có lỗi xảy ra, vui lòng thử lại.';
                if (settings.showAlert) {
                    Swal.fire({
                        text: message,
                        icon: "error",
                        confirmButtonText: "Đóng",
                        buttonsStyling: false,
                        customClass: { confirmButton: "btn btn-primary" }
                    });
                }
                if (typeof settings.onError === 'function') {
                    settings.onError(xhr, null);
                }
            }
        });
        return;
    }

    $(document).on('submit', formSelector, function (e) {
        e.preventDefault();

        const $form         = $(this);
        const formData      = new FormData(this);

        const $submitBtn    = $form.find(`button[type='submit']`);
        const $label        = $form.find('.indicator-label');
        const $progress     = $form.find('.indicator-progress');

        // Reset error UI
        $form.find('.input-error').empty().hide();
        $form.find('.is-invalid').removeClass('is-invalid');

        // Hiển thị loading
        $label.hide();
        $progress.show();
        $submitBtn.prop('disabled', true);

        // 📋 Debug log dữ liệu form
        if (settings.debug === true) {
            try {
                const entries           = [];
                for (const [key, value] of formData.entries()) {
                    let displayValue;

                    if (value instanceof File) {
                        displayValue    = `📎 File: ${value.name} (${value.size} bytes)`;
                    } else if (typeof value === 'object') {
                        displayValue    = JSON.stringify(value);
                    } else {
                        displayValue    = value;
                    }

                    entries.push({ Field: key, Value: displayValue });
                }

                if (entries.length) {
                    console.groupCollapsed(
                        `%c🧩 [Form Debug] ${formSelector}`,
                        'color:#00bcd4;font-weight:bold;font-size:12px;'
                    );
                    console.table(entries);
                    console.groupEnd();
                } else {
                    console.info(`ℹ️ [Form Debug] ${formSelector} — Không có dữ liệu trong formData.`);
                }
            } catch (err) {
                console.error('⚠️ Lỗi khi log FormData:', err);
            }
        }


        // Callback trước khi gửi
        if (typeof settings.onBeforeSend === 'function') {
            settings.onBeforeSend($form);
        }
        // add more data to formData
        for (const key in settings.data) {
            formData.append(key, settings.data[key]);
        }

        $.ajax({
            type: settings.method,
            url: settings.url || $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                resetUI();

                if (settings.showAlert) {
                    Swal.fire({
                        text: res.message ?? "Thành công!",
                        icon: "success",
                        confirmButtonText: "OK",
                        buttonsStyling: false,
                        customClass: { confirmButton: "btn btn-primary" }
                    }).then(() => {
                        if (settings.reloadOnSuccess) window.location.reload();
                        if (settings.resetForm) $form.trigger('reset');
                    });
                }

                if (typeof settings.onSuccess === 'function') {
                    settings.onSuccess(res, $form);
                }
            },
            error: function (xhr) {
                resetUI();

                const errors        = xhr.responseJSON?.errors?.details ?? {};
                const message       = xhr.responseJSON?.message ?? 'Có lỗi xảy ra, vui lòng thử lại.';

                let hasFieldError   = false;
                let errorList       = '';

                for (const field in errors) {
                    const msg       = errors[field];
                    const $input    = $form.find(`[name="${field}"]`);

                    if ($input.length) {
                        hasFieldError = true;
                        $input.addClass('is-invalid');
                        $input
                            .closest('.form-group')
                            .find('.input-error')
                            .html(msg)
                            .show();
                    }

                    errorList += `<li>${msg}</li>`;
                }

                // Nếu không có field cụ thể thì show lỗi tổng quát
                if (!hasFieldError && settings.showAlert) {
                    Swal.fire({
                        text: message,
                        icon: "error",
                        confirmButtonText: "Đóng",
                        buttonsStyling: false,
                        customClass: { confirmButton: "btn btn-primary" }
                    });
                } else if (settings.showAlert) {
                    Swal.fire({
                        html: `<div class="text-danger text-start"><ul>${errorList}</ul></div>`,
                        icon: "error",
                        confirmButtonText: "Đóng",
                        buttonsStyling: false,
                        customClass: { confirmButton: "btn btn-primary" }
                    });
                }

                if (typeof settings.onError === 'function') {
                    settings.onError(xhr, $form);
                }
            }
        });

        function resetUI() {
            $label.show();
            $progress.hide();
            $submitBtn.prop('disabled', false);
        }
    });
}
