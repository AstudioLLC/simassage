<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('advantages')->name('advantages.')->group(function (Router $router) {
    $controller = 'AdvantagesController@';
    $router->get('list', $controller . 'index')->name('index');
    $router->get('add', $controller . 'create')->name('create');
    $router->post('store', $controller . 'store')->name('store');
    $router->get('show/{id}', $controller . 'show')->name('show');
    $router->get('edit/{id}', $controller . 'edit')->name('edit');
    $router->put('edit/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id?}', $controller . 'destroy')->name('delete');

    $router->post('active/{id}', $controller . 'active')->name('active');
    $router->delete('deleteImage', $controller . 'deleteImage')->name('deleteImage');
    $router->patch('sort', $controller . 'sort')->name('sort');
});
