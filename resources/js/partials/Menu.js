export default class Menu {
  constructor () {
    this.initBurgerToggle();

    this.initMenu();
    this.activeMenu();
  }

  initBurgerToggle () {
    $('.main-nav__toggle').on('click', function () {
      $('.main-nav, .main-nav__toggle').toggleClass('main-nav__open');
    });
  }

  activeMenu () {
    const location = window.location.href;
    const cur_url = '/' + location.split('/').pop();

    $('.main-nav__item').each(function () {
      const link = $(this).find('a').attr('href');

      if (cur_url == link) {
        $(this).addClass('active');
      }
    });
  }

  initMenu () {
      if($(window).width()<='768'){
          const $catalogMenu = $('.main-nav');
          const $firstLevelBtn = $catalogMenu.find('.main-nav__btn');
          // const $firstLevelBtnHover = $catalogMenu.find('.main-nav__item--catalog, .main-nav__item--submenu');

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
}
