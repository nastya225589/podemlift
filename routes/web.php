<?php

Route::get('/', 'PageController@index');

Route::get('/story-card/{id}', 'StoryController@one');

Route::get('/new-card/{id}', 'NewsController@one');

Route::get('/services-item/{slug}', 'ServiceController@one');

Route::get('/sphere-item/{slug}', 'SphereController@one');

Route::get('/portfolio-item/{slug}', 'PortfolioController@one');

Route::get('/portfolio-card/{slug}', 'WorkController@one');

Route::post('/request-form/send', 'RequestFormController@store');

Route::post('/form-question/send', 'FormQuestionController@store');

Route::post('/questionnaire/send', 'QuestionnaireController@store');

Route::post('/back-call/send', 'BackCallController@store');

include 'catalog.php';

Route::get('{url?}', 'PageController@show')->where('url', '[A-Za-z0-9\/\-\%\w\[\]]+');
