<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('videos')->name('videos.')->group(function (Router $router) {
    $controller = 'VideosController@';
    $router->get('{video}/{key}', $controller . 'index')->name('index');
    $router->get('add/{video}/{key}', $controller . 'create')->name('create');
    $router->post('store/{video}/{key}', $controller . 'store')->name('store');
    $router->get('show/{video}/{key}/{id}', $controller . 'show')->name('show');
    $router->get('edit/{video}/{key}/{id}', $controller . 'edit')->name('edit');
    $router->put('edit/{video}/{key}/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id?}', $controller . 'destroy')->name('delete');

    $router->delete('deleteImage', $controller . 'deleteImage')->name('deleteImage');
    $router->patch('sort', $controller . 'sort')->name('sort');

    $router->delete('forceDelete/{id?}', $controller . 'forceDestroy')->name('forceDelete');
});
