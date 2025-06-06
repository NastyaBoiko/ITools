$(() => {

    $(document).on('click', '.close-category-modal', function (e) {
        e.preventDefault();
        $('#category-modal').modal('hide');
    })


    $(document).on('click', '.create-category-btn', function (e) {
        e.preventDefault();

        $('#category-modal').modal('show');
        $('#category-modal .modal-header h2').text('Создание категории');

        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            success: function (response) {
                $('#category-modal .modal-body').html(response.form)
            },
            error: function () {
                alert('Произошла ошибка при отправке данных');
            }
        })
    })

    $(document).on('submit', '#create-category-form', function (e) {
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



    $(document).on('click', '.update-category-btn', function (e) {
        e.preventDefault();

        $('#category-modal').modal('show');
        $('#category-modal .modal-header h2').text('Изменение категории');

        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            success: function (response) {
                $('#category-modal .modal-body').html(response.form)
            },
            error: function () {
                alert('Произошла ошибка при отправке данных');
            }
        })
    })

    $(document).on('submit', '#update-category-form', function (e) {
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