import UserConfig from '../config/UserConfig';

export default class PerPage {
  constructor () {
    this.userConfig = new UserConfig();

    $('.sorting-view__wrap:eq(0) button').click(e => {
      if (!$(e.target).hasClass('sorting-view__btn--active')) {
        const perPage = e.target.getAttribute('data-perpage');
        const url = this.updateURLParameter(location.href, 'page', 1);
        this.userConfig.setCookie('products_per_page', perPage);
        location.href = url;
      }
    });
  }
  updateURLParameter(url, param, paramVal){
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (var i=0; i<tempArray.length; i++){
            if(tempArray[i].split('=')[0] != param){
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
  }
}
