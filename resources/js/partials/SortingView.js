export default class SortingView {
  constructor () {
    let now = new Date(Date.now());
    let expires = new Date(now.setMonth(now.getMonth() + 1));
    let domain = location.hostname;

    $('.sorting-view__btn--line').on('click', function () {
      $('.products__wrap').toggleClass('products__sorting-view');
      $('.card').toggleClass('card__sorting-view');
      $('.sorting-view__btn--line').toggleClass('sorting-view__btn-view--active');
      $('.sorting-view__btn--grid').removeClass('sorting-view__btn-view--active');
      document.cookie = 'shorting_view_type=line; path=/; expires=' + expires + '; domain=' + domain;
    });

    $('.sorting-view__btn--grid').on('click', function () {
      $('.products__wrap').removeClass('products__sorting-view');
      $('.card').removeClass('card__sorting-view');
      $('.sorting-view__btn--grid').toggleClass('sorting-view__btn-view--active');
      $('.sorting-view__btn--line').removeClass('sorting-view__btn-view--active');
      document.cookie = 'shorting_view_type=grid; path=/; expires=' + expires + '; domain=' + domain;
    });
  }
};
