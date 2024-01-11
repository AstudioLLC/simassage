<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('gallery')->name('gallery.')->group(function (Router $router) {
    $controller = 'GalleriesController@';
    $router->get('{gallery}/{key}', $controller . 'index')->name('index');
    $router->post('store', $controller . 'store')->name('store');
    $router->put('edit/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id?}', $controller . 'destroy')->name('delete');
    $router->patch('sort', $controller . 'sort')->name('sort');
});
