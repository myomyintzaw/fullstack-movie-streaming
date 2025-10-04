<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function showLogin(){

       return view('admin.auth.login');
    }

    public function login(Request $request){
        // return $request->all();
        // return  $credentials=$request->only('email','password');

        $credentials=$request->only('email','password');
        $checkAuth=auth()->guard('admin')->attempt($credentials);
        // dd($checkAuth);
        if(!$checkAuth){
            return "wrong email & password";
            // return redirect()->intended('/admin/dashboard');
        }

        // if(auth()->guard('admin')->attempt($credentials)){
        //     return redirect()->intended('/admin/dashboard');
        // }

        // return back()->withErrors(['email'=>'Invalid Credentials']);
        // return auth()->guard('admin')->user();
        return redirect('/admin/dashboard');
    }

    public function logout(){
        auth()->guard('admin')->logout();
        // return redirect()->route('show-login');
        return redirect('/');
    }
}
