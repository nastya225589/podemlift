export default class Menu {
    constructor() {
        $('.main-nav__toggal').on('click', function() {
            $('.main-nav, .main-nav__toggal').toggleClass('main-nav__open');
        });

        const touch = $('.catalog-menu__item');
        const menuWrapper = $('.catalog-menu__list');

        $('html').click(function() {
            menuWrapper.find('.catalog-menu__submenu').slideUp(0);
        });

        menuWrapper.click(function(e) {
            e.stopPropagation();
        });

        $(touch).on('click', function(e) {
            e.preventDefault();
            const menu = $(this).closest('li').find('.catalog-menu__submenu');
            const isClosed = menu.is(':hidden'); // закрыто ли подменю, по которому кликнули

            menuWrapper.find('.catalog-menu__submenu').hide(); // закрываем все подменю

            // если меню было закрыто, то открываем его
            if (isClosed) {
                menu.slideDown(0);
            }
        });
    }
}
