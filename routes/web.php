<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

    //Home Routes
    Route::get('/','Front\HomeController@Home' )->name('Front.Home');
    Route::get('products','Front\HomeController@products' )->name('Front.products');
    Route::get('products/{id}','Front\HomeController@products_category' )->name('categories.products');
    Route::get('products-details/{id}','Front\HomeController@products_details' )->name('products.details');
    Route::get('search','Front\HomeController@search' )->name('Front.search');

    //Categories Routes
    Route::get('categories','Front\HomeController@categories' )->name('Front.categories');


   //Cart Routes
    Route::get('carts','Front\CartController@index')->name('Carts');
    Route::post('addToCart','Front\CartController@addToCart')->name('addToCart');
    Route::post('delete','Front\CartController@delete')->name('deleteToCart');
    Route::post('updateQty','Front\CartController@updateQty')->name('updateQty');

    //Checkout Routes
    Route::get('checkout','Front\SaleController@index')->name('checkout');
    Route::get('addSale','Front\SaleController@addSale')->name('addSale');
    Route::post('confirmSale/{id}','Front\SaleController@confirmSale')->name('confirmSale');

    //Users Routes
    Route::get('user/register', function () {return view('Front.user.register');})->name('user.register');
    Route::post('addUser','Front\UserController@register')->name('addUser');
    Route::get('user/login', function () {return view('Front.user.login');})->name('user.login');
    Route::post('UserLogin','Front\UserController@login')->name('UserLogin');
    Route::get('user/logout','Front\UserController@logout')->name('user.logout');

   /*======================= load cart after add product  =======================*/

   Route::get('loadNewCart','Front\CartController@loadNewCart')->name('loadNewCart');

   //********************* End Pay ***********************************

    Route::get('credit','Front\PaymobController@index');
    Route::get('callback','Front\PaymobController@callBack');
    Route::get('endPay','Front\PaymobController@endPay');


