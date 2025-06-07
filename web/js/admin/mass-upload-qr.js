$(() => {
    $(document).on('click', '.mass_check_btn', function (e) {
        e.preventDefault(); // Предотвращаем переход по ссылке

        // Находим все чекбоксы с классом .mass_download_qr_checkbox
        const checkboxes = $('.mass_download_qr_checkbox');

        // Отмечаем все чекбоксы
        checkboxes.prop('checked', true);
        $(this).addClass('d-none');
        $('.mass_uncheck_btn').removeClass('d-none');
    });

    $(document).on('click', '.mass_uncheck_btn', function (e) {
        e.preventDefault(); // Предотвращаем переход по ссылке

        // Находим все чекбоксы с классом .mass_download_qr_checkbox
        const checkboxes = $('.mass_download_qr_checkbox');

        // Отмечаем все чекбоксы
        checkboxes.prop('checked', false);
        $(this).addClass('d-none');
        $('.mass_check_btn').removeClass('d-none');
    });

    $(document).on('click', '.mass_download_qr_checkbox', function (e) {
        e.stopPropagation();
        $('.mass_check_btn').removeClass('d-none');
        $('.mass_uncheck_btn').addClass('d-none');
    });

    $(document).on('click', '.mass_download_refresh_btns', function (e) {
        $('.mass_check_btn').removeClass('d-none');
        $('.mass_uncheck_btn').addClass('d-none');
    });

    $(document).on('click', '.mass_download_qr_btn', function (e) {
        e.preventDefault();
        const selectedCheckboxes = $('.mass_download_qr_checkbox:checked');

        const selectedIds = selectedCheckboxes.map(function () {
            return $(this).data('id');
        }).get();

        if (selectedIds.length === 0) {
            alert('Отметьте чекбокс хотя бы у 1 каточки');
            return;
        }

        const url = `${$(this).attr('href')}?ids=${selectedIds.join(',')}`;
        window.location.href = url;

        selectedCheckboxes.prop('checked', false);
        $('.mass_check_btn').removeClass('d-none');
        $('.mass_uncheck_btn').addClass('d-none');
    });
})