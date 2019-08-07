<?php

Route::get('/', 'PageController@index');

include 'catalog.php';

Route::get('{url?}', 'PageController@show')->where('url', '[A-Za-z0-9/-]+');
