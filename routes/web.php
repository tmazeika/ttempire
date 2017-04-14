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

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'shop'], function () {
    Route::get('/', 'ShopController@index');

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'CartController@index');
        Route::get('add/{product}/{subQuantity}', 'CartController@add');
        Route::get('subtract/{product}/{subQuantity}', 'CartController@subtract');
        Route::get('set/{product}/{subQuantity}/{count}', 'CartController@set');
    });

    Route::get('{product}', 'ShopController@showProduct');
});

Route::get('contact', function () {
    return view('contact');
});
