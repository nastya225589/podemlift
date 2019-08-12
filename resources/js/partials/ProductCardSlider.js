export default class ProductCardSlider {
  constructor () {
    $('.product-card__proto').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.product-card__proto-nav'
    });

    $('.product-card__proto-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      asNavFor: '.product-card__proto',
      centerMode: true,
      centerPadding: '0',
      dots: false,
      prevArrow: '<span class="slick__slider slick__slider_prev"></span>',
      nextArrow: '<span class="slick__slider slick__slider_next"></span>',
      focusOnSelect: true
    });
  }
};
