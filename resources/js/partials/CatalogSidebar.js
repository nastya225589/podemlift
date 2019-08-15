export default class CatalogSidebar {
  constructor () {
    this.initCatalogSidebar();
  }

  initCatalogSidebar () {
    const $catalogMenu = $('.sidebar');
    const $firstLevelBtn = $catalogMenu.find('.sidebar__btn');

    $firstLevelBtn.on('click', function (e) {
      e.preventDefault();

      const $targetSubmenu = $(this).closest('li').find('.sidebar-submenu');
      const $openedSubmenu = $catalogMenu.find('.sidebar-submenu:visible').not($targetSubmenu);

      if ($targetSubmenu.length) {
        $targetSubmenu.slideToggle();
        $openedSubmenu.slideToggle();
      } else {
        location.href = $(this).attr('href');
      }
    });
  }
}
