$(() => {
    $('#account-tool-pjax').on('click', '.btn-return-modal', function(e) {
        e.preventDefault();

        $('#return-modal-form').attr('action', $(this).attr('href'));

        $('#return-modal').modal('show');
        // $('#return-modal').find('modal-body').load('/account/tool/return?id=20', function () {
        // })
    })

    $('#form-return-pjax').on('pjax:end', () => {
        $('#return-modal').modal('hide');

        $.pjax.reload('#account-tool-pjax');
    })
})