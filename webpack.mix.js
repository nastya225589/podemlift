const mix = require('laravel-mix');

mix.scripts([
    'node_modules/jquery/dist/jquery.js'
], 'resource/js/app.js');

mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css').options({
    processCssUrls: false
});
