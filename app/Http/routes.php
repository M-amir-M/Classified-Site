<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();

Route::get('register/confirm/{token}' , 'Auth\AuthController@confirmEmail');

Route::get('/', [
    'uses' => 'pagesController@home',
    'as' => 'home',
]);

Route::get('/getbanners', [
    'uses' => 'pagesController@banners',
    'as' => 'getbanner',
]);

Route::get('/dashboard', [
    'uses' => 'AdminController@dashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

Route::get('/banners/getCity', [
    'uses' => 'bannersController@getCity',
    'as' => 'city.getcity',
]);

Route::get('/categories/getCategory', [
    'uses' => 'bannersController@getCategory',
    'as' => 'category.getcategory',
]);

Route::get('/admin/banners/unverifiedbanners', [
    'uses' => 'bannersController@unverifiedBanners',
    'as' => 'admin.banners.unverifiedbanners',
    'middleware' => 'auth'
]);

Route::get('/banners/unverified/{banner_id}/{reason_id}', [
    'uses' => 'bannersController@unverified',
    'as' => 'admin.banners.unverified',
    'middleware' => 'auth'
]);

Route::get('/banners/verified/{id}', [
    'uses' => 'bannersController@verified',
    'as' => 'admin.banners.verified',
    'middleware' => 'auth'
]);

Route::get('/banners/banner-form/get', [
    'uses' => 'bannersController@getForm',
]);

Route::get('/banners/search', [
    'uses' => 'bannersController@search',
    'as' => 'banners.search',
]);

Route::get('/admin/{city}/{id}/{title}', [
    'uses' => 'bannersController@showBannerAdmin',
    'as' => 'admin.banners.showbanner',
    'middleware' => 'auth'
]);

Route::resource('banners','bannersController');//resource باید بالا تر از get باشد

Route::get('/banners/mybanners', [
    'uses' => 'bannersController@show',
    'as' => 'banners.mybanners',
    'middleware' => 'auth'
]);

Route::post('/banners/{banner_id}/email', [
    'uses' => 'bannersController@mail',
    'as' => 'banners.email',
    'middleware' => 'auth'
]);

Route::get('{city}/{id}/{title}', [
    'uses' => 'bannersController@showBanner',
    'as' => 'banners.showbanner',
]);

Route::get('/user/{city}/{id}/{title}', [
    'uses' => 'bannersController@userBanner',
    'as' => 'banners.userbanner',
    'middleware' => 'auth'
]);

//Route::get('{city}/{title}','bannersController@showBanner');

Route::post('/{banner_id}/photos','photosController@store')->name('photos.store');

Route::delete('/photo/{id}','photosController@destroy')->name('photos.destroy');

Route::get('/test','CategoryController@test');