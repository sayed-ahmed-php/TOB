<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->middleware(['apiLocale'])->group(function ()
{
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');

    Route::post('complaint', 'Complaint@index');
    Route::post('getInfo', 'Info@index');

    Route::post('departments', 'Parts@index');
    Route::post('products', 'Products@index');
    Route::post('product-info', 'ProductInfo@index');
    Route::post('product-search', 'ProductSearch@index');

    Route::post('favorites', 'AllFavorites@index');
    Route::post('likeProduct', 'SetFavorite@index');
    Route::post('unLikeProduct', 'RemoveFavorite@index');
    Route::post('increaseCart', 'AddProduct@index');
    Route::post('reduceCart', 'RemoveProduct@index');
    Route::post('addCart', 'SetCart@index');
    Route::post('removeCart', 'RemoveCart@index');

    Route::post('carts', 'Carts@index');
    Route::post('makeOrder', 'CreateOrder@index');
    Route::post('orders', 'Orders@index');
    Route::post('order-info', 'OrderInfo@index');

    Route::post('updateProfile', 'UpdateProfile@index');
    Route::post('changePassword', 'ResetPassword@index');

});
