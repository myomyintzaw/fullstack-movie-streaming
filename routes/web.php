<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/admin/login','admin.auth.login');
Route::view('/admin/login', 'AuthController@showLogin');
// Route::get('/admin/login',[AuthController::class,'showLogin']);
// Route::get('/admin/login',[App\Http\Controllers\Admin\AuthController::class,'showLogin']);


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

    //authenticated routes
    Route::group(['middleware'=>'RedirectIfNotAuth'], function () {
        Route::get('/logout', 'AuthController@logout');
    });
});
