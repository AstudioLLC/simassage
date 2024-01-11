<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->name('users.')->group(function (Router $router) {
    $controller = 'UsersController@';
    $router->get('list', $controller . 'index')->name('index');
//    $router->get('add', $controller . 'create')->name('create');
//    $router->post('store', $controller . 'store')->name('store');
    $router->get('show/{id}', $controller . 'show')->name('show');
    $router->get('edit/{id}', $controller . 'edit')->name('edit');
    $router->put('edit/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id?}', $controller . 'destroy')->name('delete');
    $router->patch('restore/{id}', $controller . 'restore')->name('restore');

    $router->post('active/{id}', $controller . 'active')->name('active');
    $router->delete('deleteImage', $controller . 'deleteImage')->name('deleteImage');
    $router->patch('sort', $controller . 'sort')->name('sort');

    $router->get('only-trashed', $controller . 'onlyTrashed')->name('onlyTrashed');
    $router->delete('forceDelete/{id?}', $controller . 'forceDestroy')->name('forceDelete');
});
