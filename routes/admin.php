<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    auth()->guard('admin')->logout();
    return 'success';
});

Route::get('/login', 'AuthController@showLogin')->name('show-login')->middleware('RedirectIfAdminAuth');
Route::post('/login', 'AuthController@login')->name('login');

Route::group(['middleware' => 'RedirectIfNotAdminAuth'], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    //category
    Route::resource('/category', 'CategoryController');
    //movie
    Route::resource('/movie','MovieController');
    // serie
    Route::resource('/serie','SerieController');
    Route::resource('/serie-epi','SerieEpisodeController');
    //ads management
    Route::resource('/ads','AdsController');
    Route::resource('/sub','SubController');
    Route::get('/sub-buy','SubController@showBuyList');
    // Route::get('/sub-buy','SubController@subBuy')->name('sub-buy');
    Route::get('/change-status','SubController@changeStatus');

});


Route::group(['prefix'=>'api'],function(){
    //movie
    Route::post('/store-movie','MovieController@store');
    Route::post('/update-movie/{id}','MovieController@update');
    //serie
    Route::post('/store-serie','SerieController@store');
    Route::post('update-serie/{id}','SerieController@update');
});
