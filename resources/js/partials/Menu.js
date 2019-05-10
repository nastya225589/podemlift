export default class Menu {
    constructor() {
        $('.main-nav__toggal').on('click', function() {
            $('.main-nav, .main-nav__toggal').toggleClass('main-nav__open');
        });

        // const touch = $('.main-nav__item');
        // const menuWrapper = $('.main-nav__list');
        //
        // $('html').click(function() {
        //     menuWrapper.find('.submenu').slideUp(0);
        // });
        //
        // menuWrapper.click(function(e) {
        //     e.stopPropagation();
        // });
        //
        // $(touch).on('click', function(e) {
        //     e.preventDefault();
        //     const menu = $(this).closest('li').find('.submenu');
        //     const isClosed = menu.is(':hidden'); // закрыто ли подменю, по которому кликнули
        //
        //     menuWrapper.find('.submenu').hide(); // закрываем все подменю
        //
        //     // если меню было закрыто, то открываем его
        //     if (isClosed) {
        //         menu.slideDown(0);
        //     }
        // });
    }
}
