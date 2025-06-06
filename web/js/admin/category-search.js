$(() => {
    $('#admin-category-pjax').on('change', 'select', function () {
        $('#category-search-form').submit();
    })

    $('#admin-category-pjax').on('change', 'input', function () {
        $('#category-search-form').submit();
    })
})