export default class Menu {
    constructor() {
        this.initBurgerToggle();
        this.initCatalogSidebar();
    }

    initBurgerToggle() {
        $('.main-nav__toggle').on('click', function() {
            $('.main-nav, .main-nav__toggle').toggleClass('main-nav__open');
        });
    }

    initCatalogSidebar() {
        const $catalogMenu = $('.catalog-menu');
        const $firstLevelLink = $catalogMenu.find('.catalog-menu__item > .main-nav__link');

        $firstLevelLink.on('click', function(e) {
            e.preventDefault();

            const $targetSubmenu = $(this).closest('li').find('.catalog-menu__submenu');
            const $openedSubmenu = $catalogMenu.find('.catalog-menu__submenu:visible').not($targetSubmenu);

            if ($targetSubmenu.length) {
                $targetSubmenu.slideToggle();
                $openedSubmenu.slideToggle();
            } else {
                location.href = $(this).attr('href');
            }
        })
    }
}
