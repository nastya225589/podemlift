export default class Tabs {
  constructor () {
    $(function () {
      $('#tabs').tabs({
        active: 0
      });
    });

    $(function () {
      $('#accordion').accordion({
        collapsible: true,
        active: false,
        heightStyle: 'content'
      });
    });
  }
};
