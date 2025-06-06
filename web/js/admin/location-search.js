$(() => {
    $('#admin-location-pjax').on('change', 'select', function () {
        $('#location-search-form').submit();
    })

    $('#admin-location-pjax').on('change', 'input', function () {
        $('#location-search-form').submit();
    })
})