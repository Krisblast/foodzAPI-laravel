<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\LoginController@register');

Route::get('restaurants', 'RestaurantController@index');
Route::get('items/{filters?}/{lat?}/{lng?}', 'MenuItemController@index');
Route::get('types', 'TypeController@index');

Route::get('restaurants/{id}/items', 'RestaurantController@getMenuItemsByRestaurantId');

Route::group([
    'prefix' => 'restricted',
    'middleware' => 'auth:api',
], function () {
    // Authentication Routes...

    Route::post('restaurants', 'RestaurantController@store');

    Route::post('items', 'MenuItemController@store');

    Route::post('types', 'TypeController@store');

    Route::get('orders', 'OrderController@index');
    Route::post('orders', 'OrderController@store');

    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});