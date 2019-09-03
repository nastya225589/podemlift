export default class Filters {
  constructor () {
    $('.catalog__btn-dashed_filter').on('click', function () {
      $('.catalog-menu').toggleClass('catalog-menu--open');
    });

    $('.filters__btn-close').on('click', function () {
      $('.catalog-menu').removeClass('catalog-menu--open');
    });

    $('.filters__btn-clear_wrap').click(function (e) {
      e.preventDefault();
      const resetUrl = $('.filters__btn-clear_wrap').attr('reset');
      if (resetUrl)
        location = resetUrl;
      else  
        location = location.pathname;
    });

    $('#filters-form').submit(function () {
      const resetUrl = $('.filters__btn-clear_wrap').attr('reset');
      let formQuery = '';
      if ($('#filters-form').serialize()) {
        formQuery = '?' + $('#filters-form').serialize();
        if (formQuery.split('&').length === 1) {
          let propery = formQuery.split('=')[0];
          let value = formQuery.split('=')[1];

          if (propery.indexOf('%5B%5D') !== -1)
            propery = propery.replace('%5B%5D', '');

          propery = propery.replace('?', '');
          formQuery = '/' + propery + '/' + value;
        }
      }

      if (resetUrl)
        window.location = (resetUrl + formQuery);
      else
        window.location = window.location.pathname + formQuery;
      return false;
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
