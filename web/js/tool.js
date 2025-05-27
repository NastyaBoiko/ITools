$(() => {
    $('.tool-form').on('change', function () {
        console.log($('#tool-tool_maker_id').val());
        if ($('#tool-tool_maker_id').val() == -1) {
            $('.field-tool-new_tool_maker').addClass('mb-3');
            $('.field-tool-new_tool_maker').fadeIn();
        } else {
            $('.field-tool-new_tool_maker').fadeOut();
        }
    })
})