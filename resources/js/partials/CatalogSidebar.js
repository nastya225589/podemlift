export default class CatalogSidebar {
    constructor() {
        this.initCatalogSidebar();
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
