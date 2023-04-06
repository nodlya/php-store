<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
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




Route::name('user.')->prefix('user')->group(function () {
    Auth::routes();
});
//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@authenticated')->name('login');
Route::name('user.')->prefix('user')->group(function () {
    Route::get('index', 'App\Http\Controllers\UserController@index')->name('index');
    Auth::routes();
});

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('index', 'App\Http\Controllers\Admin\IndexController')->name('index');
});

Route::post('/basket/saveorder', 'App\Http\Controllers\BasketController@saveOrder')->name('basket.saveorder');

Route::get('/basket/success', 'App\Http\Controllers\BasketController@success')
    ->name('basket.success');

Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('index', 'IndexController')->name('index');
});

Route::group([
    'as' => 'admin.', // имя маршрута, например admin.index
    'prefix' => 'admin', // префикс маршрута, например admin/index
    'namespace' => 'App\Http\Controllers\Admin', // пространство имен контроллера
    'middleware' => ['auth', 'admin'] // один или несколько посредников
], function () {
    // главная страница панели управления
    Route::get('index', 'App\Http\Controllers\Admin\IndexController')->name('index');
    // CRUD-операции над категориями каталога
    Route::resource('category', 'App\Http\Controllers\Admin\CategoryController');
});

Storage::disk('local')->put('data/file.txt', 'Some file content');
