<?php

namespace App\Http\Controllers;

use App\Models\BuyPackage;
use App\Models\Sub;
use App\Models\UserRemainDay;
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
            'user_id' => Auth::id(),
            // 'sub_id' => $data->id,
            'payment_name' => request()->payment_name,
            'payment_no' => request()->payment_phone,
            'payment_image' => $file_name,
            'package_total_day' => $data->total_day,
            'package_price' => $data->price,
            'package_name' => $data->name,
        ]);

        return redirect('/')->with('success', 'Package purchase request submitted successfully');
    }

    public function changeStatus(Request $request)
    {
        $buy_package_id = $request->buy_package_id;
        $status = $request->status;

        if ($status == 'error') {
            BuyPackage::where('id', $buy_package_id)->update([
                'status' => 'error'
            ]);
        }

        if ($status == 'pending') {
            BuyPackage::where('id', $buy_package_id)->update([
                'status' => 'pending'
            ]);
        }

        if ($status == 'success') {
            $data = BuyPackage::where('id', $buy_package_id)->first();
            BuyPackage::where('id', $buy_package_id)->update([
                'status' => 'success'
            ]);

            //update user subscribtion info
            // $user=$data->user;
            // $user->sub_status=1;
            // $user->sub_end_date=now()->addDays($data->package_total_day);
            // $user->save();
            $user_remain_date = UserRemainDay::find('user->id', $data->user_id)->first();
            if (!$user_remain_date) {
                $total_day = $data->package_total_day;
                $expire_date = date("Y-m-d", strtotime('+' . $total_day . "days"));
                UserRemainDay::create([
                    'expire_date' => $expire_date,
                ]);
            } else {

                UserRemainDay::where('user_id', $data->user_id)->update([]);
            }
        }
    }
}
