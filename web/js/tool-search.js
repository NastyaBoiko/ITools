$(() => {
    $('#account-tool-pjax').on('change', 'select', function () {
        console.log('here');
        $('#tool-search-form').submit();
    })

    $('#account-tool-pjax').on('change', 'input', function () {
        console.log('here');
        $('#tool-search-form').submit();
    })
})