export default class Filters {
    constructor() {
        $('.catalog__btn-dashed_filter').on('click', function() {
            $('.catalog-menu').toggleClass('catalog-menu--open');
        });

        $('.filters__btn-close').on('click', function() {
            $('.catalog-menu').removeClass('catalog-menu--open');
        });

        const _R = document.getElementById('days-css'),
            _W = _R.parentNode,
            _O = _R.nextElementSibling;

        document.documentElement.classList.add('js');

        _R.addEventListener('input', e => {
            _O.value = _R.value;
            _W.style.setProperty('--val', +_R.value)
        }, false);
    }
}
