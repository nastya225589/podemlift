export default class Menu {
    constructor() {

        const touch = $('.main-nav__item');
        const menuWrapper = $('.main-nav__list');
        const w = $(window).width();

        $('html').click(function() {
            menuWrapper.find('.submenu').slideUp(0);
        });

        menuWrapper.click(function(e) {
            e.stopPropagation();
        });

        $(touch).on('click', function(e) {
            e.preventDefault();
            var menu = $(this).closest('li').find('.submenu');
            var isClosed = menu.is(':hidden'); // закрыто ли подменю, по которому кликнули

            menuWrapper.find('.submenu').slideUp(0); // закрываем все подменю

            // если меню было закрыто, то открываем его
            if (isClosed) {
                menu.slideDown(0);
            }
        });
    }
}
