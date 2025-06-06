$(() => {
    $('.create-user-modal-btn').on('click', function (e) {
        e.preventDefault();
        $('#user-index-modal').modal('show');

        $('#user-index-modal .modal-body').load('/admin/user/register-ajax');
    })
})