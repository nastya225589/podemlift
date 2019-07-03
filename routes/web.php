<?php

Route::get('/', 'PageController@index');
Route::get('{url?}', 'PageController@show')->where('url', '[A-Za-z0-9/-]+');
