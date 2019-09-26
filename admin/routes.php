<?php

Route::middleware(['web'])->group(function () {
    Route::prefix('admin/user')->group(function () {
        // user auth
        Route::post('login', add_controller_ns('LoginController@login'));
        Route::post('logout', add_controller_ns('LoginController@logout'))->name('logout');
        Route::get('login', add_controller_ns('LoginController@showLoginForm'))->name('login');

        // user password reset
        Route::get('password/reset', add_controller_ns('ForgotPasswordController@showLinkRequestForm'))->name('password.request');
        Route::post('password/email', add_controller_ns('ForgotPasswordController@sendResetLinkEmail'))->name('password.email');
        Route::get('password/reset/{token}', add_controller_ns('ResetPasswordController@showResetForm'))->name('password.reset');
        Route::post('password/reset', add_controller_ns('ResetPasswordController@reset'));
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', add_controller_ns('AdminController@index'))->name('admin.index');
        Route::post('nestable/save', add_controller_ns('NestableController@save'))->name('nestable.save');
        Route::get('log', add_controller_ns('LogController@index'))->name('log.index');
        Route::get('settings', add_controller_ns('SettingsController@index'))->name('settings.index');
        Route::post('settings', add_controller_ns('SettingsController@index'));
        Route::post('image/upload', add_controller_ns('ImageController@upload'));

        Route::resource('user', add_controller_ns('UserController'));

        Route::resource('page', add_controller_ns('PageController'));
        Route::prefix('page')->group(function () {
            Route::get('copy/{id}', add_controller_ns('PageController@copy'))->name("page.copy");
            Route::get('child/{id}', add_controller_ns('PageController@child'))->name("page.child");
        });

        Route::resource('product', add_controller_ns('ProductController'));
        Route::resource('product-category', add_controller_ns('ProductCategoryController'));
        Route::prefix('product-category')->group(function () {
            Route::get('copy/{id}', add_controller_ns('ProductCategoryController@copy'))->name("product-category.copy");
            Route::get('child/{id}', add_controller_ns('ProductCategoryController@child'))->name("product-category.child");
        });

        Route::resource('service', add_controller_ns('ServiceController'));
        Route::resource('service-category', add_controller_ns('ServiceCategoryController'));
        Route::prefix('service-category')->group(function () {
            Route::get('copy/{id}', add_controller_ns('ServiceCategoryController@copy'))->name("service-category.copy");
            Route::get('child/{id}', add_controller_ns('ServiceCategoryController@child'))->name("service-category.child");
        });

        Route::resource('work', add_controller_ns('WorkController'));
        Route::resource('work-category', add_controller_ns('WorkCategoryController'));
        Route::prefix('work-category')->group(function () {
            Route::get('copy/{id}', add_controller_ns('WorkCategoryController@copy'))->name("work-category.copy");
            Route::get('child/{id}', add_controller_ns('WorkCategoryController@child'))->name("work-category.child");
        });

        Route::resource('client', add_controller_ns('ClientController'));

        Route::resource('product-property', add_controller_ns('ProductPropertyController'));
        Route::resource('seo-data', add_controller_ns('SeoDataController'));
        Route::resource('project-request', add_controller_ns('ProjectRequestController'));
        Route::resource('questionnaire', add_controller_ns('QuestionnaireController'));
        Route::resource('back-call', add_controller_ns('BackCallController'));
        Route::resource('news', add_controller_ns('NewsController'));
        Route::resource('story', add_controller_ns('StoryController'));
        Route::resource('application-sphere', add_controller_ns('ApplicationSphereController'));
    });
});
