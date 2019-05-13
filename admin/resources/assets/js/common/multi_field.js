$(function () {
    if (!$('.multi').length)
        return;

    $('.multi .item').append(`
        <div class="multi-controls">
            <div class="add"></div>        
            <div class="delete"></div>        
        </div>
    `);

    $('.multi').each(function () {
        if ($(this).find('.item').length === 1)
            $(this).find('.delete').hide();
    });

    $(document).on('click', '.multi-controls .add', function () {
        var $container = $(this).closest('.multi'),
            $item = $(this).closest('.item'),
            template = $('<div>').append($container.find('.item:first').clone()).html(),
            index = new Date().getTime() / 1000 | 0;

        $template = $(template.replace(/\[(\d+)\]/g, `[${index}]`));
        $template.find('input, textarea').val('');
        $template.find('.upload-image-preview').html('');
        $item.after($template);
        $container.find('.delete').show();
    });

    $(document).on('click', '.multi-controls .delete', function () {
        var $container = $(this).closest('.multi'),
            $item = $(this).closest('.item'),
            count = $container.find('.item').length - 1;

        $item.remove();
        if (count <= 1)
            $container.find('.item .delete').hide();
    });
});