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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
    Route::prefix('product')->group(function () {
    Route::get('/', 'ProductController@index')->name('productIndex');
    Route::get('/add', 'ProductController@add');
    Route::get('/edit/{product_id}', 'ProductController@edit');
    Route::post('/confirm', 'ProductController@confirm');
    Route::post('/complete', 'ProductController@complete');
});
