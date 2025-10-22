<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        //validation
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        //check email already exist
        $checkEmail=User::where('email',$request->email)->first();
        if($checkEmail){
            return redirect()->back()->with('error','Email already exist.');
        }

        //store to database
        $created_user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        //login
        // auth()->login($created_user);
        Auth::login($created_user);
        return redirect('/')->with('success',"welcome ".$created_user->name);
    }
    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success',"logout success.");
    }


    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        //validate
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        //check password
        $cre = $request->only('email','password');
        if (Auth::attempt($cre)) {
            return redirect('/')->with('success', "welcome " . Auth::user()->name);
        }
        return redirect()->back()->with('error', 'Invalid credentials wrong email and password');

    }



    public function changePassword(){
        $current_password=request()->current_password;
        $new_password=request()->new_password;

        //check current password
        $hashed_password=User::where('id',Auth::id())->first()->password;
        $check_password=Hash::check($current_password,$hashed_password);
        if(!$check_password){
            return 'wrong_current';
        }

        //update password or set new password
        User::where('id',Auth::id())->update([
            'password'=>Hash::make($new_password),
        ]);

        return 'success';
    }
}
