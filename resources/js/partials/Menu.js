export default class Menu {
  constructor () {
    this.initBurgerToggle();
    this.initMenu();
  }

  initBurgerToggle () {
    $('.main-nav__toggle').on('click', function () {
      $('.main-nav, .main-nav__toggle').toggleClass('main-nav__open');
    });
  }

  initMenu () {
    const $catalogMenu = $('.main-nav');
    const $firstLevelBtn = $catalogMenu.find('.main-nav__btn');

    $firstLevelBtn.on('click', function (e) {
      e.preventDefault();

      const $targetSubmenu = $(this).closest('li').find('.submenu');
      const $openedSubmenu = $catalogMenu.find('.submenu:visible').not($targetSubmenu);

      if ($targetSubmenu.length) {
        $targetSubmenu.slideToggle();
        $openedSubmenu.slideToggle();
      } else {
        location.href = $(this).attr('href');
      }
    });
  }
}
