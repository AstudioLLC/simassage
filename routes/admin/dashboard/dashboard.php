<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->group(function (Router $router) {
    $controller = 'DashboardController@';
    $router->get('', $controller . 'index')->name('index');
});
