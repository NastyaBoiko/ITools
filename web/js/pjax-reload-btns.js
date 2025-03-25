$(() => {

    $('#card-return-pjax').on('click', '.btn-control', function(e) {
        e.preventDefault();
        
        // Отправляем AJAX-запрос для смены статуса
        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            success(response) {
                // Перезагружаем pjax-контейнер после успешного запроса
                if (response.status) {
                    $.pjax.reload({
                        container: '#card-return-pjax', // Укажите ваш pjax-контейнер
                        push: false, // Не добавляем в историю браузера
                        timeout: 5000,
                    });
                }
            },
            error(xhr, status, error) {
                // Обработка ошибок
                console.error('Ошибка при смене статуса:', error);
            }
        });
    })
})