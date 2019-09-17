<?php

Route::get('/', 'PageController@index');

Route::post('/request-form/send', 'RequestFormController@store');

include 'catalog.php';

Route::get('{url?}', 'PageController@show')->where('url', '[A-Za-z0-9\/\-\%\w\[\]]+');
