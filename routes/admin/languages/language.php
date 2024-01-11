<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*Route::prefix('languages')->name('languages.')->group(function (Router $router) {
            $controller = 'LanguagesController@';
            $router->get('', $controller . 'main')->name('main');
            $router->patch('', $controller . 'editLanguage');
            $router->patch('sort', $controller . 'sort')->middleware('ajax')->name('sort')->middleware('admin:manager.admin');
});*/

Route::prefix('languages')->name('languages.')->group(function (Router $router) {
    $controller = 'LanguagesController@';
    $router->get('', $controller . 'index')->name('index');
    $router->get('add', $controller . 'create')->name('create');
    $router->post('store', $controller . 'store')->name('store');
    $router->get('show/{id}', $controller . 'show')->name('show');
    $router->get('edit/{id}', $controller . 'edit')->name('edit');
    $router->put('edit/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id}', $controller . 'destroy')->name('delete');
    //$router->delete('deleteImage', $controller . 'deleteImage')->name('deleteImage');
    $router->patch('sort', $controller . 'sort')->name('sort');

    $router->post('admin/{id}', $controller . 'admin')->name('admin');
    $router->post('url/{id}', $controller . 'url')->name('url');
    $router->post('default/{id}', $controller . 'default')->name('default');
    $router->post('active/{id}', $controller . 'active')->name('active');
});
