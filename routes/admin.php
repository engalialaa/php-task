<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin'], function () {
    Route::get('login',function (){
        if (Auth::guard('admin')->check()){
            return redirect('admin/home');
        }
        return view('Admin/auth/login');
    });
    Route::post('do-log','Admin\AuthController@login')->name('do-log');


    //******* after login *******
    Route::group(['middleware' => 'admin:admin'], function () {

        Route::get('log-out','Admin\AuthController@logout')->name('log-out');
//
//        Route::get('/',function (){return redirect('admin/home');})->name('/');

        Route::get('home','Admin\HomeController@index')->name('home');


        ################################### Admins ##########################################
        Route::get('admins','Admin\AdminController@index')->name('admin.index');
        Route::get('adminData','Admin\AdminController@adminData')->name('adminData');
        Route::post('try_delete_admin','Admin\AdminController@delete')->name('try_delete_admin');
        Route::post('add_admin','Admin\AdminController@add')->name('add_admin');
        Route::post('edit_admin','Admin\AdminController@edit')->name('edit_admin');

        ################################### Profile ##########################################
        Route::get('my_profile','Admin\AdminController@my_profile')->name('my_profile');
        Route::post('store-profile','Admin\AdminController@save_profile')->name('store-profile');



        ################################### Category ##########################################
        Route::resource('category','Admin\CategoryController');
        Route::get('categoryData','Admin\CategoryController@categoryData')->name('categoryData');
        Route::post('addCategory','Admin\CategoryController@addCategory')->name('addCategory');
        Route::get('editCategory/{id}','Admin\CategoryController@editCategory')->name('editCategory');
        Route::post('updateCategory','Admin\CategoryController@updateCategory')->name('updateCategory');
        Route::post('deleteCategory','Admin\CategoryController@deleteCategory')->name('deleteCategory');
        Route::post('category_status','Admin\CategoryController@category_status')->name('category_status');



        ################################### products ##########################################

        //Books Ebhar Route
        Route::get('products','Admin\ProductsController@index')->name('products');
        Route::get('create/product','Admin\ProductsController@create_product')->name('create.product');
        Route::post('store/product','Admin\ProductsController@store_product')->name('product.store');
        Route::get('edit/product/{id}','Admin\ProductsController@edit_product')->name('edit.product');
        Route::post('update/product','Admin\ProductsController@update_product')->name('update.product');
        Route::get('productsData','Admin\ProductsController@productsData')->name('productsData');
        Route::get('ProductDetails/{id}','Admin\ProductsController@ProductDetails')->name('ProductDetails');
        Route::post('delete_book','BookController@delete')->name('delete_book');
        Route::post('is_shown_product','Admin\ProductsController@is_shown_product')->name('is_shown_product');


        Route::get('products/Category/{id}','Admin\ProductsController@productsCategory')->name('productsCategory');
        Route::get('productsCategoryData/{id}','Admin\ProductsController@productsCategoryData')->name('productsCategoryData');



        ################################### Cart ##########################################
        //New Order Routes
        Route::get('order/new','Admin\CartController@index')->name('cart.index');
        Route::get('cartsData','Admin\CartController@cartsData')->name('cartsData');
        Route::post('delete_cart','Admin\CartController@delete')->name('delete_cart');
        Route::get('details/{id}','Admin\CartController@details');
        Route::post('making_order','Admin\CartController@making_order')->name('making_order');
        Route::post('delivry_order','Admin\CartController@delivry_order')->name('delivry_order');
        Route::post('ending_order','Admin\CartController@ending_order')->name('ending_order');
        Route::post('refusal_order','Admin\CartController@refusal_order')->name('refusal_order');

        //Confirm Order Routes
        Route::get('order/confirm','Admin\CartController@confirmOrder')->name('confirm_order');
        Route::get('Confirm_cartsData','Admin\CartController@Confirm_cartsData')->name('Confirm_cartsData');


    });//end Middleware Admin

});//end Prefix
