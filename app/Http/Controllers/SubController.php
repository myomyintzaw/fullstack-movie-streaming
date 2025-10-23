<?php

namespace App\Http\Controllers;

use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubController extends Controller
{
    public function index()
    {
       $data=Sub::all();
        return view('sub.all',compact('data'));
    }
    public function buyPackage($slug)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error','You need to login first to buy a package');
        }

        $data=Sub::where('slug',$slug)->first();
        if(!$data){
            return redirect()->back()->with('error','Package not found');
        }
        return view('sub.buy',compact('data'));
    }


    public function buyPackageStore(){
        return request()->all();
    }


}

