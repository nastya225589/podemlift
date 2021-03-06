import Page from './pages/Page';
import Catalog from './pages/Catalog';
import Product from './pages/Product';

window.jQuery = window.$ = require('jquery');

require('slick-carousel/slick/slick.js');
require('jquery.maskedinput/src/jquery.maskedinput');
require('jquery-ui/ui/widgets/tabs');
require('jquery-ui/ui/widgets/accordion');

switch (document.body.dataset.page) {
  case 'catalog':
    new Catalog();
    break;
  case 'product':
    new Product();
    break;
  default:
    new Page();
}
