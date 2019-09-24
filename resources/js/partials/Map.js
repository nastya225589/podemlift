export default class Map {
  constructor () {
    this.init();
  }

  init () {
    if (document.getElementById('map')) {
      ymaps.ready(function () {
        var myMap = new ymaps.Map('map', {
          center: [59.923739, 30.244254],
          zoom: 16,
          controls: []
        });

        var myPlacemark = new ymaps.Placemark(myMap.getCenter(), {

        }, {
          iconLayout: 'default#image',
          iconImageHref: 'images/icon/logo-map.svg',
          iconImageSize: [68, 94],
          iconImageOffset: [-45, -100]
        });

        myMap.geoObjects
          .add(myPlacemark);
      });
    }
  }
}
