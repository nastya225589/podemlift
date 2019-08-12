export default class MenuFooter {
  constructor () {
    $('#footer-nav__toggle').on('click', function () {
      $('.footer-nav__wrap').toggleClass('footer-nav__open');
    });
  }
}
