export default class Tabs
{
    constructor () {
        $( function() {
            $( "#tabs" ).tabs({
                active: 0
            });
        });
    }
};
