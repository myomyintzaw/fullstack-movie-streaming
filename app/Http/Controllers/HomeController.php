<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Serie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $latest_movie=Movie::orderBy('id','desc')->take(6)->get();
    //   return  $latest_serie=Serie::orderBy('id','desc')->take(6)->get();
        $latest_serie=Serie::orderBy('id','desc')->take(6)->get();

        return view('home',compact('latest_movie','latest_serie'));
    }

    public function dashboard(){

        return view('dashboard');
    }
}
