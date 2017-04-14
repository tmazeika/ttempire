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
    Route::get('{product}', 'ShopController@showProduct');
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('{product}/add', 'CartController@add');
    Route::get('{product}/subtract', 'CartController@subtract');
});

Route::get('contact', function () {
    return view('contact');
});
