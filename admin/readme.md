add to package.json "devDependencies"

```
"@tinymce/tinymce-react": "^2.4.0",
"tinymce": "4.9.2",
"tinymce-i18n": "18.11.18",
"nestable": "0.2.0",
"react-sortable-hoc": "^1.4.0",
```

run `./artisan preset react`

add to webpack.mix.js

```
// admin
mix.copy('node_modules/tinymce/skins', 'public/js/skins');
mix.copy('node_modules/tinymce-i18n/langs/ru.js', 'public/js/langs/ru.js');

mix.react('admin/resources/assets/js/admin.js', 'public/js')
   .sass('admin/resources/assets/sass/admin.scss', 'public/css');
```

run `npm i && npm run dev`

add to config/app.php

```
'providers' => [
...
        Admin\Providers\AdminServiceProvider::class,
        Admin\Providers\EventServiceProvider::class,
        Admin\Providers\BladeServiceProvider::class,
...        
```

change in config/auth.php

`'model' => Admin\Models\User::class`

change composer.json "autoload" to

```
"autoload": {
    "files": [
        "admin/helpers.php"
    ],
    "psr-4": {
        "App\\": "app/",
        "Admin\\": "admin/"
    },
    ...
```

run `composer install`

configure .env database and run `./artisan migrate`

comment in Http/Kernel.php line 
`\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class`