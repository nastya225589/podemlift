export default class Form {
  constructor () {
    $(function () {
      $('input[name="phone"]').mask('8 (999) 999-99-99');
    });
  }
}
