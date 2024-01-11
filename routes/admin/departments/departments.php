<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('departments')->name('departments.')->group(function (Router $router) {
    $controller = 'DepartmentsController@';

    $router->get('list/{parentId?}', $controller . 'index')->name('index');
    $router->post('listPortion', $controller . 'listPortion')->name('listPortion');
    $router->get('create/{parentId?}', $controller . 'create')->name('create');
    $router->post('store', $controller . 'store')->name('store');
    $router->get('service/{parentId}', $controller . 'service')->name('service');
    $router->post('services/add/{id?}',$controller . 'serviceAdd')->name('service.add');
    $router->get('personnel/{parentId}', $controller . 'personnel')->name('personnel');
    $router->post('personnel/add/{id?}',$controller . 'personnelAdd')->name('personnel.add');
    $router->get('price/{parentId}', $controller . 'price')->name('price');
    $router->post('prices/add/{id?}',$controller . 'priceAdd')->name('price.add');

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
