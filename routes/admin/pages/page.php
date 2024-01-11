<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('pages')->name('pages.')->group(function (Router $router) {
    $controller = 'PagesController@';
    $router->get('list/{parentId?}', $controller . 'index')->name('index');
    $router->get('add/{parentId?}', $controller . 'create')->name('create');
    $router->post('store', $controller . 'store')->name('store');
    $router->get('show/{id}', $controller . 'show')->name('show');
    $router->get('edit/{id}', $controller . 'edit')->name('edit');
    $router->put('edit/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id?}', $controller . 'destroy')->name('delete');
    $router->patch('restore/{id}', $controller . 'restore')->name('restore');

    $router->post('active/{id}', $controller . 'active')->name('active');
    $router->post('form-active/{id}', $controller . 'formActive')->name('formActive');
    $router->post('form-active-doctor/{id}', $controller . 'formActiveDoctor')->name('formActiveDoctor');

    $router->delete('deleteImage', $controller . 'deleteImage')->name('destroyImage');
    $router->delete('iconDelete', $controller . 'iconDelete')->name('deleteIcon');

    $router->patch('sort', $controller . 'sort')->name('sort');

    $router->get('only-trashed', $controller . 'onlyTrashed')->name('onlyTrashed');
    $router->delete('forceDelete/{id?}', $controller . 'forceDestroy')->name('forceDelete');
});
