$(() => {
    $('.card').on('click', '.btn-return-modal', function(e) {
        e.preventDefault();

        $('#return-modal-view').find('.modal-body').load($(this).attr('href'), function () {
            $('#return-modal-view').modal('show');
        })
    })

    $('#return-modal-view').on('pjax:end', '#form-return-pjax', () => {
        $('#return-modal-view').modal('hide');
        $.pjax.reload('#card-return-pjax');
    })
})