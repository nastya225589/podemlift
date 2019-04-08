import Menu from '../partials/Menu';
import ExamplesSlider from '../partials/ExamplesSlider';
import ClientsSlider from '../partials/ClientsSlider';
import Form from '../partials/Form';

export default class Page {
    constructor() {
        new Menu;
        new ExamplesSlider;
        new ClientsSlider;
        new Form;
    }
}
