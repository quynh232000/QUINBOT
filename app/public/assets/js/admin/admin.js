$(document).ready(function () {
    if ($('.list_check_all').length > 0) {
        $('.list_check_all').on('change', function () {
            $(`input[name="id[]"]`).prop('checked', $(this).prop('checked'))
        })
    }
    //    generate slug
    $('.generate-slug').on('input', function () {
        var title   = $(this).val();
        var slug    = generateSlug(title.trim());
        $("#slug").val(slug);
    });
});
