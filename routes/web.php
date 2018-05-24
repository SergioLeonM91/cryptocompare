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

Route::get('cryptocurrencies/index', ['as' => 'cryptocurrencies.index','uses' => 'cryptocurrencies\ctlrCryptocurrencies@index']);

Route::post('cryptocurrencies/compare', ['as' => 'cryptocurrencies.compare','uses' => 'cryptocurrencies\ctlrCryptocurrencies@compare']);