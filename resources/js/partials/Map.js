export default class Map {
    constructor () {
        ymaps.ready(init);
        function init(){
            var myMap = new ymaps.Map("map", {
                center: [59.923739, 30.244254],
                zoom: 15
            });
        }
    }
}
