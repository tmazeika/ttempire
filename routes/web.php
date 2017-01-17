<?php

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localize',
        'localizationRedirect',
        'localeSessionRedirect',
    ]
], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/contact', 'ContactController@index');

    Route::group(['prefix' => 'shop'], function() {
        Route::get('/', 'ShopController@index');

        Route::get('/cart/add', 'ShopController@addCartProductQty');
        Route::get('/cart/set', 'ShopController@setCartProductQty');
        Route::get('/cart/reset', 'ShopController@resetCart');
    });
});
