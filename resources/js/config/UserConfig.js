import Cookies from 'js-cookie';

export default class UserConfig {
  constructor () {
    this.domain = location.hostname;
  }

  setCookie (name, value) {
    Cookies.set(name, value, { expires: 30, domain: this.domain, path: '/' });
  }
};
