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
    return view('welcome');
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('orders', 'OrdersController@index');
Route::post('orders/create', 'OrdersController@store');
Route::post('orders/accept', 'OrdersController@accept');
Route::get('track/{tracking_number}', 'OrdersController@trackShipment');
Route::resource('packages', 'PackagesController');
