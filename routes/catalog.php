<?php

$resource = \App\Models\Page::where('behavior', 'catalog')->first();

Route::get('/catalog/child', 'CatalogController@product');

Route::get($resource->url, [
    'resource' => $resource,
    'uses' => 'CatalogController@index'
]);

Route::get($resource->url . '{url}', [
    'resource' => $resource,
    'uses' => 'CatalogController@category'
])->where('url', '[A-Za-z0-9/-]+');
