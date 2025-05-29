$(() => {
    $('.location-index').on('click', '.edit-location-button', function (e) {
        e.preventDefault();

        $('#location-modal-update').modal('show');

        const modelId = $(this).data('id'); // Получаем ID модели из кнопки
        const modalBody = $('#location-modal-update .modal-body'); // Находим тело модального окна

        // Отправляем AJAX-запрос на сервер
        $.ajax({
            url: '/admin/location/update-ajax', // URL действия контроллера
            type: 'GET',
            data: { id: modelId }, // Передаем ID модели
            success: function (response) {
                modalBody.html(response); // Вставляем ответ (HTML формы) в модальное окно
            },
            error: function () {
                alert('Ошибка загрузки данных.');
            }
        });
    });

    $('.location-index').on('click', '.close-location-modal-update', function (e) {
        e.preventDefault();
        $('#location-modal-update').modal('hide');
    })
})