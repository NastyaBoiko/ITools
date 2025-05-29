$(() => {
    $('.location-index').on('click', '.edit-location-button', function (e) {
        e.preventDefault();

        $('#update-location-modal-form').attr('action', $(this).attr('href'));

        $('#location-modal-update').find('.modal-body').load($(this).attr('href'), function () {
            $('#location-modal-update').modal('show');
        })
    });

    $('.location-index').on('click', '.close-location-modal-update', function (e) {
        e.preventDefault();
        $('#location-modal-update').modal('hide');
    })
})