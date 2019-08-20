export default class Submenu {
    constructor () {
        this.initSubmenu();
    }

    initSubmenu () {
        const $catalogMenu = $('.submenu');
        const $firstLevelBtn = $catalogMenu.find('.submenu__btn');

        $firstLevelBtn.on('click', function (e) {
            e.preventDefault();

            const $targetSubmenu = $(this).closest('li').find('.submenu-lev2');
            const $openedSubmenu = $catalogMenu.find('.submenu-lev2:visible').not($targetSubmenu);

            if ($targetSubmenu.length) {
                $targetSubmenu.slideToggle();
                $openedSubmenu.slideToggle();
            } else {
                location.href = $(this).attr('href');
            }
        });
    }
}
