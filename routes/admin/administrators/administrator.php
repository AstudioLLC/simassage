<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('administrators')->name('administrators.')->group(function (Router $router) {
    $controller = 'AdministratorsController@';

    $router->get('list', $controller . 'index')->name('index');
    $router->post('listPortion', $controller . 'listPortion')->name('listPortion');
    $router->get('add', $controller . 'create')->name('create');
    $router->post('store', $controller . 'store')->name('store');

    $router->get('show/{id}', $controller . 'show')->name('show');
    $router->get('edit/{id}', $controller . 'edit')->name('edit');
    $router->put('edit/{id}', $controller . 'update')->name('update');
    $router->delete('delete/{id?}', $controller . 'destroy')->name('delete');
    //$router->patch('restore/{id}', $controller . 'restore')->name('restore');

    $router->post('active/{id}', $controller . 'active')->name('active');
    //$router->delete('deleteImage', $controller . 'deleteImage')->name('deleteImage');
    //$router->patch('sort', $controller . 'sort')->name('sort');

    //$router->get('only-trashed', $controller . 'onlyTrashed')->name('onlyTrashed');
    //$router->delete('forceDelete/{id?}', $controller . 'forceDestroy')->name('forceDelete');

    /*
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

    $router->get('', $controller . 'index')->name('index');
    $router->post('listPortion', $controller . 'listPortion')->name('listPortion');
    $router->get('accept/{id}', $controller . 'acceptEmail')->name('accept.email');
    $router->get('discount/{id}', $controller . 'userDiscount')->name('discount');
    $router->get('view/{id}', $controller . 'view')->name('view');
    $router->post('discount/add/{id}', $controller . 'addDiscountToUser')->name('add.discount');
    $router->get('add/admins/{role}', $controller . 'addAdminsByType')->name('add.admin');
    $router->post('add/admins/put/{role}', $controller . 'addAdminsByType')->name('add_put.admin');
    $router->patch('toggle-active', $controller . 'toggleActive')->name('toggleActive');
    $router->delete('delete', $controller . 'delete')->name('delete');
    $router->get('statistics', $controller . 'statistics')->name('statistics');*/
});

/*Route::namespace('Users')->prefix('retail-users')->name('retail-users.')->group(function (Router $router) {
    $c = 'RetailUsersController@';
    $router->get('', $c . 'index')->name('index');
    $router->post('listPortion', $c . 'listPortion')->name('listPortion');
});

Route::namespace('Users')->prefix('wholesale-users')->name('wholesale-users.')->group(function (Router $router) {
    $c = 'WholesaleUsersController@';
    $router->get('', $c . 'index')->name('index');
    $router->post('listPortion', $c . 'listPortion')->name('listPortion');
});

Route::prefix('users')->name('users.')->group(function (Router $router) {
            $c = 'UsersController@';

            $router->get('type/{role?}', $c . 'main')->name('main');
            $router->get('company/package/{id}', $c . 'packagesEdit')->name('package.edit');
            $router->post('company/package/submit/{id}', $c . 'packagesEditSubmit')->name('packages.submit');
            $router->get('magazine', $c . 'magazine')->name('view.magazine');
            $router->get('accept/{id}', $c . 'acceptEmail')->name('accept.email');
            $router->get('discount/{id}', $c . 'userDiscount')->name('discount');
            $router->get('view/{id}', $c . 'view')->name('view');
            $router->get('add/{type}', $c . 'addUserByType')->name('add');
            $router->post('add/{type}', $c . 'addUserByType')->name('add_put');
            $router->post('discount/add/{id}', $c . 'addDiscountToUser')->name('add.discount');
            $router->get('add/admins/{role}', $c . 'addAdminsByType')->name('add.admin');
            $router->post('add/admins/put/{role}', $c . 'addAdminsByType')->name('add_put.admin');
            $router->patch('toggle-active', $c . 'toggleActive')->name('toggleActive');
            $router->delete('delete', $c . 'delete')->name('delete');
        });
*/
