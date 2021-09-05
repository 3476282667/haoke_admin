<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\HousesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/admin');

Route::middleware('CORS')->group(function () {
    Route::get('/user', [UserController::class, 'user']);
    Route::post('/user/verification', [UserController::class, 'verification']);
    Route::post('/user/login', [UserController::class, 'login']);
    Route::post('/user/register', [UserController::class, 'registered']);
    Route::post('/user/logout', [UserController::class, 'logout']);
    Route::post('/user/favorite', [UserController::class, 'favorite']);
    Route::post('/user/modifyAvatar', [UserController::class, 'modifyAvatar']);
    Route::post('/user/uploadInfo', [UserController::class, 'uploadInfo']);
    Route::any('/user/favorites', [UserController::class, 'favorites']);
    Route::any('/user/houses', [UserController::class, 'houses']);
    Route::any('/user/history', [UserController::class, 'history']);
});

Route::middleware('CORS')->group(function () {
    Route::get('/area/community', [AreaController::class, 'community']);
    Route::get('/area/citylist', [AreaController::class, 'citylist']);
    Route::get('/area/hot', [AreaController::class, 'hot']);
    Route::get('/area/info', [AreaController::class, 'info']);
    Route::get('/area/map', [AreaController::class, 'map']);
});

Route::middleware('CORS')->group(function () {
    Route::get('/houses', [HousesController::class, 'index']);
    Route::get('/houses/condition', [HousesController::class, 'condition']);
    Route::get('/houses/search', [HousesController::class, 'search']);
    Route::get('/houses/house', [HousesController::class, 'house']);
    Route::get('/houses/houseDetail', [HousesController::class, 'houseDetail']);
    Route::post('/houses/image', [HousesController::class, 'upload_image']);
});

Route::middleware('CORS')->group(function () {
    Route::get('/home/recommend', [HomeController::class, 'recommend']);
    Route::get('/home/group', [HomeController::class, 'group']);
    Route::get('/home/swiper', [HomeController::class, 'swiper']);
});

