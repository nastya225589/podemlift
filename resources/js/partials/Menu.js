export default class Menu {
    constructor() {
        $('.main-nav__item--main').on ('click', function() {
            $('.submenu-main').toggleClass('submenu-main__active')
        });

        $('.main-nav__item--submenu').on ('click', function() {
            $('.submenu').toggleClass('submenu__active')
        });

        $('.main-nav__item--submenu2').on ('click', function() {
            $('.submenu2').toggleClass('submenu__active')
        });
    }
}
