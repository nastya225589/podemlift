import Menu from '../partials/Menu';
import Submenu from '../partials/Submenu';
import MenuFooter from '../partials/MenuFooter';
import ExamplesSlider from '../partials/ExamplesSlider';
import ClientsSlider from '../partials/ClientsSlider';
import Form from '../partials/Form';
import FormPopup from '../partials/FormPopup';
import ProductCardSlider from '../partials/ProductCardSlider';
import Map from '../partials/Map';

export default class Page {
  constructor () {
    new Menu();
    new Submenu();
    new MenuFooter();
    new ExamplesSlider();
    new ClientsSlider();
    new Form();
    new FormPopup();
    new ProductCardSlider();
    new Map();
  }
}
