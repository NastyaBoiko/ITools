$(() => {
    $('#tool-search-form').on('change', 'select', function () {
        $('#tool-search-form').submit();
    })

    $('#tool-search-form').on('change', 'input', function () {
        $('#tool-search-form').submit();
    })
})