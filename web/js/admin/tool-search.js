$(() => {
    $('#admin-tool-pjax').on('change', 'select', function () {
        $('#tool-search-form').submit();
    })

    $('#admin-tool-pjax').on('change', 'input', function () {
        if ($(this).is('input:not(:checkbox.mass_download_qr_checkbox)')) {
            $('#tool-search-form').submit();
        }
    })
})