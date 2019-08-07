<?php

Route::get('/', 'PageController@index');

$resource = \App\Models\Page::where('behavior', 'catalog')->first();
Route::get($resource->url, [
    'resource' => $resource,
    'uses' => 'CatalogController@index'
]);
Route::get($resource->url . '{url}', [
    'resource' => $resource,
    'uses' => 'CatalogController@show'
])->where('url', '[A-Za-z0-9/-]+');

Route::get('{url?}', 'PageController@show')->where('url', '[A-Za-z0-9/-]+');
