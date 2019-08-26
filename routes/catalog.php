<?php

$resource = \App\Models\Page::where('behavior', 'catalog')->first();

Route::get('/product/{slug}', 'CatalogController@product');

Route::get($resource->url, [
    'resource' => $resource,
    'uses' => 'CatalogController@index'
]);

Route::get($resource->url . '{url}/{property}/{value}', [
    'resource' => $resource,
    'uses' => 'CatalogController@singleFilterCategory'
])->where('url', '[A-Za-z0-9/-]+');

Route::get($resource->url . '{url}', [
    'resource' => $resource,
    'uses' => 'CatalogController@category'
])->where('url', '[A-Za-z0-9/-]+');
