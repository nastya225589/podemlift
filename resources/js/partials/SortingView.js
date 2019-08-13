import UserConfig from '../config/UserConfig';

export default class SortingView {
  constructor () {
    this.userConfig = new UserConfig();

    $('.sorting-view__btn--line').on('click', () => {
      $('.products__wrap').toggleClass('products__sorting-view');
      $('.card').toggleClass('card__sorting-view');
      $('.sorting-view__btn--line').toggleClass('sorting-view__btn-view--active');
      $('.sorting-view__btn--grid').removeClass('sorting-view__btn-view--active');
      this.userConfig.setCookie('shorting_view_type', 'line');
    });

    $('.sorting-view__btn--grid').on('click', () => {
      $('.products__wrap').removeClass('products__sorting-view');
      $('.card').removeClass('card__sorting-view');
      $('.sorting-view__btn--grid').toggleClass('sorting-view__btn-view--active');
      $('.sorting-view__btn--line').removeClass('sorting-view__btn-view--active');
      this.userConfig.setCookie('shorting_view_type', 'grid');
    });
  }
};
