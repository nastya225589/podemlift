import UserConfig from '../config/UserConfig';

export default class PerPage {
  constructor () {
    this.userConfig = new UserConfig();
    this.attachEvents();
  }

  attachEvents () {
    this.changeProductsOnPage();
  }

  changeProductsOnPage () {
    $('.sorting-view__wrap:eq(0) button').click(e => {
      if (!$(e.target).hasClass('sorting-view__btn--active')) {
        const perPage = e.target.getAttribute('data-perpage');
        this.userConfig.setProductsPerPage(perPage);
        location.href = location.pathname;
      }
    });
  }
}
