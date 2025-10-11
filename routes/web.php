<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/admin/login','admin.auth.login');
Route::view('/admin/login','AuthController@showLogin');
// Route::get('/admin/login',[AuthController::class,'showLogin']);
// Route::get('/admin/login',[App\Http\Controllers\Admin\AuthController::class,'showLogin']);


Route::namespace("App\Http\Controllers")->group(function(){
    Route::get('/','HomeController@home');
});
