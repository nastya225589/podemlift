export default class Filters {
  constructor () {
    $('.catalog__btn-dashed_filter').on('click', function () {
      $('.catalog-menu').toggleClass('catalog-menu--open');
    });

    $('.filters__btn-close').on('click', function () {
      $('.catalog-menu').removeClass('catalog-menu--open');
    });

    $('.filters__btn-clear_wrap').click(function(e) {
      e.preventDefault();
      const resetUrl = $('.filters__btn-clear_wrap').attr('reset');
      if (resetUrl)
        location = resetUrl;
      else  
        location = location.pathname;
    });

    const inputs = document.getElementsByClassName('range-input');
    if (inputs) {
      for (let input of inputs) {
        const parent = input.parentNode;
        const nextEl = input.nextElementSibling;
        const slug = input.getAttribute('slug');

        input.addEventListener('input', e => {
          nextEl.value = input.value;
          input.setAttribute('name', slug);
          parent.style.setProperty('--val', +input.value);
        }, false);
      }
    }
  }
}
