<?php

namespace App\Http\Controllers;

use App\Models\BuyPackage;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubController extends Controller
{
    public function index()
    {
        $data = Sub::all();
        return view('sub.all', compact('data'));
    }
    public function buyPackage($slug)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You need to login first to buy a package');
        }

        $data = Sub::where('slug', $slug)->first();
        if (!$data) {
            return redirect()->back()->with('error', 'Package not found');
        }
        return view('sub.buy', compact('data'));
    }


    public function buyPackageStore($slug)
    {

        request()->validate([
            'payment_name' => 'required',
            'payment_phone' => 'required',
            'payment_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $data = Sub::where('slug', $slug)->first();
        if (!$data) {
            return redirect()->back()->with('error', 'Package not found');
        }

        $file = request()->file('payment_image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);
        BuyPackage::create([

            'payment_name' => request()->payment_name,
            'payment_no' => request()->payment_phone,
            'payment_image' => $file_name,
            'package_total_day' => $data->total_day,
            'package_price' => $data->price,
            'package_name' => $data->name,
        ]);

        return redirect('/')->with('success', 'Package purchase request submitted successfully');
    }
}
