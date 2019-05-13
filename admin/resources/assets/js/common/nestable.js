require('jquery');
require('nestable');

$(function () {
    let resource = location.pathname.split('/')[2];
    if ($('.nestable').length) {
        $('.nestable').nestable();
        $('.nestable').on('change', function() {
            $.post('/admin/nestable/save', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                resource: resource,
                data: $(this).nestable('serialize')
            });
        });

        // setTimeout(function() {
        //     $('button[data-action="collapse"]').click();
        // }, 1000)
    }
});