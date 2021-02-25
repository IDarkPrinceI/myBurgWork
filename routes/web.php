<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'MainController@index')->name('index');
Route::get('/menu', 'ProductController@menu')->name('menu');
Route::get('/menu/{slug}', 'ProductController@show')->name('menu.show');
Route::get('/menu/{category}/{slug}', 'ProductController@single')->name('menu.single');

Route::get('/cartAdd/{slug}', 'CartController@cartAdd')->name('cart.add');
Route::get('/cartClear', 'CartController@cartClear')->name('cart.clear');
Route::get('/cartDell/{slug}', 'CartController@cartDell')->name('cart.dell');
Route::get('/getOrder', 'CartController@getOrder')->middleware('user')->name('cart.getOrder');
Route::get('/cartReCalc/{qty}', 'CartController@cartReCalc')->middleware('user')->name('cart.reCalc');
Route::post('/confirmOrder', 'CartController@confirmOrder')->middleware('user')->name('cart.confirmOrder');

Route::get('/register', 'UserController@create')->name('register.create');
Route::post('/register', 'UserController@store')->name('register.store');
Route::get('/login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@authenticate')->name('login.authenticate');
Route::get('/logout', 'UserController@logout')->name('logout');

//far
Route::group(['prefix' => 'far', 'namespace' => 'Far', 'middleware' => 'far'], function () {
    Route::get('/', 'MainController@index')->name('far.index');
    Route::resource('/categories', 'CategoryController');
    Route::get('/products/search', 'ProductController@search')->name('product.search');
    Route::resource('/products', 'ProductController');
    Route::get('/orders', 'OrderController@index')->name('far.orderIndex');
});





