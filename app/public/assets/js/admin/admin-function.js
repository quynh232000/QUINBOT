function confirmDeletion(id, url, r = 'this') {

    Swal.fire({
        text: "Are you sure you want to delete " + r + "?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (t) {
        if (t.value) {
            handleConfirmDelete(id, url)
        } else if (t.dismiss === "cancel") {
            Swal.fire({
                text: r + " was not deleted.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            })
        }
    });

}

function handleConfirmDelete(id, url, r) {

    ids = []
    if (id == 0) {
        $('input[name="id[]"]:checked').map(function () {
            ids.push($(this).val());
        });
    } else {
        ids = [id]
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            id: ids,
        },
        datatype: "html",
        success: (res) => {
            if (res.status) {
                Swal.fire({
                    text: res.message ?? ("You have deleted " + r + "!"),
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary"
                    }
                }).then(function () {
                    window.location.reload();
                })
            } else {
                Swal.fire({
                    text: res.message ?? (r + " was not deleted."),
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary"
                    }
                })
            }
        },
        error: function (error) {

            console.log('Somthing wrong: ', error);
            Swal.fire({
                text: error.statusText ?? (r + " was not deleted."),
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary"
                }
            })
        },
    });
    //return false;
}
function generateSlug(str) {
    str = str.toLowerCase();
    str = str.replace(/đ/g, "d");
    str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    str = str
        .replace(/[^a-z0-9\s-]/g, "")
        .replace(/\s+/g, "-")
        .replace(/-+/g, "-");

    return str;
}
function helperSelectAddress(element, apiUrl = '') {

    if (!element || !apiUrl) return;

    const $el = $(element);
    const nextField = $el.data('next');//country_id => city_id
    const selectedId = $el.val();
    const fieldName = $el.attr('name');

    if (!nextField) return;

    $.ajax({
        type: 'POST',
        url: apiUrl,
        dataType: 'json',
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            type: fieldName,
            id: selectedId
        },
        success: function (res) {
            if (!Array.isArray(res)) return;

            const optionsHtml = ['<option value="">-- Chọn --</option>']
                .concat(res.map(item =>
                    `<option value="${item.id}">${item.name}</option>`
                ))
                .join('');

            const $nextSelect = $(`select[name="${nextField}"]`);
            if ($nextSelect.length) {
                $nextSelect.html(optionsHtml);
            }
        },
        beforeSend: function () {
            $(`select[name="${nextField}"]`).html('<option>Đang tải...</option>');
        },
        error: function (xhr, status, error) {
            console.error('Lỗi khi tải địa chỉ:', status, error);
        }
    });
}
