$(() => {
    $('#card-return-pjax').on('click', '.btn-control', function(e) {
        e.preventDefault();

        const href = $(this).attr('href');

        // Отправляем AJAX-запрос для смены статуса
        $.ajax({
            url: href,
            type: 'POST',
            success: function(response) {
                // Перезагружаем pjax-контейнер после успешного запроса
                $.pjax.reload({
                    container: '#card-return-pjax', // Укажите ваш pjax-контейнер
                    push: false, // Не добавляем в историю браузера
                    replace: false // Не заменяем текущий URL
                });
            },
            error: function(xhr, status, error) {
                // Обработка ошибок
                console.error('Ошибка при смене статуса:', error);
            }
        });
    })
})