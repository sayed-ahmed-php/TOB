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
    return redirect('/ar/dashboard');
});

Route::get('admin', function () {
    return redirect('/ar/dashboard');
});

Route::get('admin/login', 'Dashboard\LoginController@index')->name('admin.login');
Route::post('admin/login', 'Dashboard\LoginController@login')->name('admin.login');

Route::namespace('Dashboard')->prefix('{lang}/dashboard')->middleware(['admin:admin', 'locale'])->name('admin.')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::delete('admins/multiDelete', 'AdminController@multiDelete')->name('admins.multiDelete');
    Route::any('admins/search', 'AdminController@search')->name('admins.search');
    Route::resource('admins', 'AdminController');

    Route::delete('banners/multiDelete', 'BannerController@multiDelete')->name('banners.multiDelete');
    Route::any('banners/search', 'BannerController@search')->name('banners.search');
    Route::resource('banners', 'BannerController');

    Route::delete('conditions/multiDelete', 'ConditionController@multiDelete')->name('conditions.multiDelete');
    Route::any('conditions/search', 'ConditionController@search')->name('conditions.search');
    Route::resource('conditions', 'ConditionController');

    Route::delete('departments/multiDelete', 'DepartmentController@multiDelete')->name('departments.multiDelete');
    Route::any('departments/search', 'DepartmentController@search')->name('departments.search');
    Route::resource('departments', 'DepartmentController');

    Route::delete('orders/multiDelete', 'OrderController@multiDelete')->name('orders.multiDelete');
    Route::any('orders/search', 'OrderController@search')->name('orders.search');
    Route::resource('orders', 'OrderController');

    Route::delete('products/multiDelete', 'ProductController@multiDelete')->name('products.multiDelete');
    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');

    Route::delete('productImages/multiDelete', 'ProductImageController@multiDelete')->name('productImages.multiDelete');
    Route::resource('productImages', 'ProductImageController');

    Route::delete('users/multiDelete', 'UserController@multiDelete')->name('users.multiDelete');
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');

    Route::delete('userOrders/multiDelete', 'UserOrderController@multiDelete')->name('userOrders.multiDelete');
    Route::resource('userOrders', 'UserOrderController');

    Route::resource('settings', 'SettingController');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
