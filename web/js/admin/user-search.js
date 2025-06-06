$(() => {
    $('#admin-user-pjax').on('change', 'select', function () {
        $('#user-search-form').submit();
    })

    $('#admin-user-pjax').on('change', 'input', function () {
        $('#user-search-form').submit();
    })
})