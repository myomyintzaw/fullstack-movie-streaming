<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\BuyPackage;
use App\Models\Sub;
use App\Models\UserRemainDay;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubController extends Controller
{


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


              $user_remain_date = UserRemainDay::where('user_id', $data->user_id)->first();
            if (!$user_remain_date) {
                $total_day = $data->package_total_day;
                $expire_date = date("Y-m-d", strtotime('+' . $total_day . "days"));
                UserRemainDay::create([
                    'user_id' => $data->user_id,
                    'expire_date' => $expire_date,
                ]);
            } else {
                $user_remain_date = UserRemainDay::where('user_id', $data->user_id)->first();
                $db_expire_date = date($user_remain_date->expire_date);
                $expire_date = date('Y-m-d',strtotime($db_expire_date . "+" . $data->package_total_day . "days"));
                UserRemainDay::where('user_id', $data->user_id)->update([
                    'expire_date' => $expire_date,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Status changed successfully');
    }






    public function showBuyList()
    {
        $data = BuyPackage::orderBy('id', 'desc')->with('user')->paginate(12);
        return view('admin.sub.buy', compact('data'));
    }


    public function index()
    {
        $data = Sub::all();
        // dd($data -> toArray());
        return view('admin.sub.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sub.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'total_day' => "required",
            'price' => "required",
        ]);

        Sub::create([
            'slug' => Str::slug($request->name),
            'name' => $request->name,
            'total_day' => $request->total_day,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {    // return $id;
        $data = Sub::find($id);
        return view('admin.sub.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Sub::where('id', $id)->update([
            'name' => $request->name,
            'total_day' => $request->total_day,
            'price' => $request->price,
        ]);
        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Sub::where('id', $id)->delete();
        return back()->with('success', 'Category Deleted Successfully');
    }
}
