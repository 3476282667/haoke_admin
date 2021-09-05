<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('/settings', 'SettingsController@index');
    $router->resource('/userlist', 'UserController');
    $router->resource('/houses', 'HouseController');
    $router->resource('/area', 'CityController');
    $router->resource('/swiper', 'SwiperController');
    $router->resource('/village', 'AreaController');
});
