$(() => {
    let currentText = $('.btn-exit').html();
    // Функция для изменения текста кнопки
    function updateButtonText() {
        if ($(window).width() < 450) {
            $('.btn-exit').html('<i class="fas fa-sign-out-alt mx-1" aria-hidden="true"></i> Выход');
        } else {
            $('.btn-exit').html(currentText);
        }
    }

    // Вызов функции при загрузке страницы
    $(document).ready(function () {
        updateButtonText();
    });

    // Вызов функции при изменении размера окна
    $(window).on('resize', function () {
        updateButtonText();
    });
})