$(() => {
    // Находим элемент alert
    const $alert = $('.alert');

    // Автоматически скрываем alert через 5 секунд
    setTimeout(() => {
        $alert.fadeOut(500, function () {
            $alert.remove(); // Удаляем элемент после исчезновения
        });
    }, 5000);
})