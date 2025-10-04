<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // if(auth()->guard('admin')->check()){
        //     // return redirect()->route('admin.show-login');
        //     return auth()->guard('admin')->user();
        // }else{
        //     return 'no';
        // }
        return view('admin.dashboard');
    }
}
