<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('file')->name('file.')->group(function (Router $router) {
    $controller = 'FilesController@';
    $router->get('{file}/{key}', $controller . 'index')->name('index');
    $router->get('add/{file}/{key}', $controller . 'create')->name('create');
    $router->post('store/{file}/{key}', $controller . 'store')->name('store');
    $router->get('show/{file}/{key}/{id}', $controller . 'show')->name('show');
    $router->get('edit/{file}/{key}/{id}', $controller . 'edit')->name('edit');
    $router->put('edit/{file}/{key}/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id?}', $controller . 'destroy')->name('delete');

    $router->delete('deleteImage', $controller . 'deleteImage')->name('deleteImage');
    $router->patch('sort', $controller . 'sort')->name('sort');

    $router->delete('forceDelete/{id?}', $controller . 'forceDestroy')->name('forceDelete');
});


/*Route::prefix('file')->name('file.')->group(function (Router $router) {
    $c='FilesController@';
    $router->get('{file}/{key?}', $c . 'main')->name('main');
    $router->get('add/{file}/{key}', $c . 'add')->name('add');
    $router->put('add/{file}/{key}', $c . 'add_put');
    $router->get('edit/{file}/{key}/{id}', $c . 'edit')->name('edit');
    $router->patch('edit/{file}/{key}/{id}', $c . 'edit_patch');
    $router->delete('delete', $c . 'delete')->name('delete');
    $router->patch('sort', $c . 'sort')->name('sort');
});*/
