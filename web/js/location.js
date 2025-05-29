$(() => {
    $('.location-index').on('click', '.open-location-modal', function (e) {
        e.preventDefault();

        $('#location-title').val('');
        $('#location-title').removeClass('is-valid is-invalid');
        $('#location-modal').modal('show');
    })

    $('.location-index').on('click', '.close-location-modal', function (e) {
        e.preventDefault();
        $('#location-modal').modal('hide');
    })
})