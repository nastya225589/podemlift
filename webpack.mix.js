const mix = require('laravel-mix');

mix.react('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .version();

// admin
mix.copy('node_modules/tinymce/skins', 'public/js/skins');
mix.copy('node_modules/tinymce-i18n/langs/ru.js', 'public/js/langs/ru.js');

mix.react('admin/resources/assets/js/admin.js', 'public/js')
    .sass('admin/resources/assets/sass/admin.scss', 'public/css')
    .version();
