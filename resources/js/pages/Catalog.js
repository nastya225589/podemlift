import Page from './Page';
import SortingView from '../partials/SortingView';
import Filters from '../partials/Filters';
import CatalogSidebar from '../partials/CatalogSidebar';
import PerPage from '../partials/PerPage';

export default class Catalog {
  constructor () {
    new Page();
    new SortingView();
    new Filters();
    new CatalogSidebar();
    new PerPage().attachEvents();
  }
}
