<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/admin/login','admin.auth.login');
Route::view('/admin/login', 'AuthController@showLogin');
// Route::get('/admin/login',[AuthController::class,'showLogin']);
// Route::get('/admin/login',[App\Http\Controllers\Admin\AuthController::class,'showLogin']);


Route::get('/test',function(){
return Auth::user();
});

Route::namespace("App\Http\Controllers")->group(function () {
    //auth routes
    Route::group(['middleware' => 'RedireIfAuth'], function () {
        Route::get('/register', 'AuthController@showRegister');
        Route::post('/register', 'AuthController@register');

        Route::get('/login', 'AuthController@showLogin');
        Route::post('/login', 'AuthController@login');
    });


    Route::get('/', 'HomeController@home');

    //movie
    Route::get('/movie','MovieController@all');
    Route::get('/movie/{slug}','MovieController@detail');

    //serie
    Route::get('/serie','SerieController@all');
    Route::get('/serie/{slug}','SerieController@detail');

    //subscribtion
    Route::get('/sub','SubController@index');
    Route::get('/buy-package/{slug}','SubController@buyPackage');
    Route::post('/buy-package/{slug}','SubController@buyPackageStore');
    Route::get('/api/buy-package-list','SubController@getBuyPackageList');


    //authenticated routes
    Route::group(['middleware'=>'RedirectIfNotAuth'], function () {
        //dashboard
        Route::get('/dashboard','HomeController@dashboard');
        Route::get('/api/get-saved-movies','MovieController@getSavedMovies');
        Route::get('/api/get-saved-series','SerieController@getSavedSeries');
        Route::post('/api/change-password','AuthController@changePassword');
        //auth routes logout
        Route::get('/logout', 'AuthController@logout');
        // movie routes
        Route::post('/api/store-movie-comment','MovieController@storeComment');
        Route::post('/api/store-movie-like','MovieController@like');
        Route::post('/api/store-movie-save','MovieController@saveMovie');
        // serie routes
        Route::post('/api/store-serie-comment','SerieController@storeComment');
        Route::post('/api/store-serie-like','SerieController@like');
        Route::post('/api/store-serie-save','SerieController@saveMovie');
    });
});
