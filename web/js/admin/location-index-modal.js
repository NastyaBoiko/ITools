$(() => {

    $(document).on('click', '.close-location-modal', function (e) {
        e.preventDefault();
        $('#location-modal').modal('hide');
    })


    $(document).on('click', '.create-location-btn', function (e) {
        e.preventDefault();

        $('#location-modal').modal('show');
        $('#location-modal .modal-header h2').text('Создание категории');

        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            success: function (response) {
                $('#location-modal .modal-body').html(response.form)
            },
            error: function () {
                alert('Произошла ошибка при отправке данных');
            }
        })
    })

    $(document).on('submit', '#create-location-form', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }

                $('#modal .modal-body').html(response.form);
            },
            error: function () {
                alert('Произошла ошибка при отправке данных');
            }
        })
    })



    $(document).on('click', '.update-location-btn', function (e) {
        e.preventDefault();

        $('#location-modal').modal('show');
        $('#location-modal .modal-header h2').text('Изменение категории');

        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            success: function (response) {
                $('#location-modal .modal-body').html(response.form)
            },
            error: function () {
                alert('Произошла ошибка при отправке данных');
            }
        })
    })

    $(document).on('submit', '#update-location-form', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }

                $('#modal .modal-body').html(response.form);
            },
            error: function () {
                alert('Произошла ошибка при отправке данных');
            }
        })
    })

})