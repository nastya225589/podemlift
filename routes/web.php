<?php

Route::get('/', 'PageController@index');

Route::get('/news', 'NewsController@all');

Route::get('/new-card/{id}', 'NewsController@one');

Route::get('/services-item/{slug}', 'ServiceController@getService');

Route::post('/request-form/send', 'RequestFormController@store');

Route::post('/questionnaire/send', 'QuestionnaireController@store');

Route::post('/back-call/send', 'BackCallController@store');

include 'catalog.php';

Route::get('{url?}', 'PageController@show')->where('url', '[A-Za-z0-9\/\-\%\w\[\]]+');
