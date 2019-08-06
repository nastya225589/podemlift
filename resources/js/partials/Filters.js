export default class Filters {
    constructor() {
        $('.catalog__btn-dashed_filter').on('click', function() {
            $('.catalog-menu').toggleClass('catalog-menu--open');
        });

        $('.filters__btn-close').on('click', function() {
            $('.catalog-menu').removeClass('catalog-menu--open');
        });

        const input = document.getElementById('range-input');
        if (input)  {
            const parent = input.parentNode;
            const nextEl = input.nextElementSibling;

            input.addEventListener('input', e => {
                nextEl.value = input.value;
                parent.style.setProperty('--val', + input.value)
            }, false);
        }
    }
}
