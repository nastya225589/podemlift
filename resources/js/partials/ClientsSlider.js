export default class ClientsSlider {
  constructor () {
    $('.clients__list').slick({
      arrows: true,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 1,
      dots: false,
      prevArrow: '<span class="slick__slider slick__slider_prev"></span>',
      nextArrow: '<span class="slick__slider slick__slider_next"></span>',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  }
};
