<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [IndexController::class, '__invoke'] )->name('index');

Route::get('/catalog/index', 'App\Http\Controllers\CatalogController@index')->name('catalog.index');
Route::get('/catalog/category/{slug}', 'App\Http\Controllers\CatalogController@category')->name('catalog.category');
Route::get('/catalog/product/{slug}', 'App\Http\Controllers\CatalogController@product')->name('catalog.product');

Route::get('/basket/index', 'App\Http\Controllers\BasketController@index')->name('basket.index');
Route::get('/basket/checkout', 'App\Http\Controllers\BasketController@checkout')->name('basket.checkout');

Route::post('/basket/add/{id}', 'App\Http\Controllers\BasketController@add')->where('id', '[0-9]+')->name('basket.add');

Route::post('/basket/plus/{id}', 'App\Http\Controllers\BasketController@plus')->where('id', '[0-9]+')->name('basket.plus');

Route::post('/basket/minus/{id}', 'App\Http\Controllers\BasketController@minus')->where('id', '[0-9]+')->name('basket.minus');

Route::post('/basket/remove/{id}', 'App\Http\Controllers\BasketController@remove')->where('id', '[0-9]+')->name('basket.remove');

Route::post('/basket/clear', 'App\Http\Controllers\BasketController@clear')->name('basket.clear');

Route::get('/brands', 'App\Http\Controllers\CatalogController@showBrands')->name('catalog.brand');
