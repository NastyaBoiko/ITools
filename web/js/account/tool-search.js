$(() => {
    $('#account-tool-pjax').on('change', 'select', function () {
        $('#tool-search-form').submit();
    })

    $('#account-tool-pjax').on('change', 'input', function () {
        $('#tool-search-form').submit();
    })
})