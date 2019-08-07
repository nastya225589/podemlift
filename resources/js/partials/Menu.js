export default class Menu {
    constructor() {
        this.initBurgerToggle();
    }

    initBurgerToggle() {
        $('.main-nav__toggle').on('click', function() {
            $('.main-nav, .main-nav__toggle').toggleClass('main-nav__open');
        });
    }
}
