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

Route::resource('addresses', 'AddressController');

Route::group([
    'prefix' => 'messages',
], function () {
    Route::get('/', 'MessageController@index');
    Route::get('/{message}', 'MessageController@show');
    Route::post('receive', 'MessageController@store');
});

Route::get('/', 'MainController@index');
Route::get('/{inbox}/{selectedMessage?}', 'MainController@messages');