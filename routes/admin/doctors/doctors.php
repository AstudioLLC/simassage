
<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('doctors')->name('doctors.')->group(function (Router $router) {
    $controller = 'MembersController@';

    $router->get('list', $controller . 'index')->name('index');
    $router->post('listPortion', $controller . 'listPortion')->name('listPortion');
    $router->get('create', $controller . 'create')->name('create');
    $router->post('store', $controller . 'store')->name('store');

    $router->get('show/{id}', $controller . 'show')->name('show');
    $router->get('edit/{id}', $controller . 'edit')->name('edit');
    $router->put('edit/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id?}', $controller . 'destroy')->name('delete');
    $router->patch('restore/{id}', $controller . 'restore')->name('restore');

    $router->post('active/{id}', $controller . 'active')->name('active');
    $router->post('inHome/{id}', $controller . 'show_home')->name('show_home');
    $router->delete('deleteImage', $controller . 'deleteImage')->name('deleteImage');
    $router->patch('sort', $controller . 'sort')->name('sort');

    $router->get('only-trashed', $controller . 'onlyTrashed')->name('onlyTrashed');
    $router->delete('forceDelete/{id?}', $controller . 'forceDestroy')->name('forceDelete');
});
