export default class SortingView {
  constructor () {
    const Cookies = require('js-cookie');
    const domain = location.hostname;

    $('.sorting-view__btn--line').on('click', function () {
      $('.products__wrap').toggleClass('products__sorting-view');
      $('.card').toggleClass('card__sorting-view');
      $('.sorting-view__btn--line').toggleClass('sorting-view__btn-view--active');
      $('.sorting-view__btn--grid').removeClass('sorting-view__btn-view--active');
      Cookies.set('shorting_view_type', 'line', { expires: 30, domain: domain });
    });

    $('.sorting-view__btn--grid').on('click', function () {
      $('.products__wrap').removeClass('products__sorting-view');
      $('.card').removeClass('card__sorting-view');
      $('.sorting-view__btn--grid').toggleClass('sorting-view__btn-view--active');
      $('.sorting-view__btn--line').removeClass('sorting-view__btn-view--active');
      Cookies.set('shorting_view_type', 'grid', { expires: 30, domain: domain });
    });
  }
};
