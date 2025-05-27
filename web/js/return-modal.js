$(() => {
    $('#account-tool-pjax').on('click', '.btn-return-modal', function(e) {
        e.preventDefault();

        $('#return-modal-form').attr('action', $(this).attr('href'));

        $('#return-modal').find('.modal-body').load($(this).attr('href'), function () {
            $('#return-modal').modal('show');
        })
    })


    $('#return-modal').on('pjax:end', '#form-return-pjax', () => {
        $('#return-modal').modal('hide');
        $.pjax.reload('#account-tool-pjax');
    })
})

