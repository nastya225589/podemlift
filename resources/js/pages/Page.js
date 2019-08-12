import Menu from '../partials/Menu';
import MenuFooter from '../partials/MenuFooter';
import ExamplesSlider from '../partials/ExamplesSlider';
import ClientsSlider from '../partials/ClientsSlider';
import Form from '../partials/Form';
import ProductCardSlider from '../partials/ProductCardSlider';

export default class Page {
  constructor () {
    new Menu();
    new MenuFooter();
    new ExamplesSlider();
    new ClientsSlider();
    new Form();
    new ProductCardSlider();
  }
}
