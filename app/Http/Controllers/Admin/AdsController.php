<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
     public function index()
    {
        $data=Ads::orderBy('id','desc')->get();
        // dd($data -> toArray());
        return view('admin.ads.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ads.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
          'ads_type'=>"required",
          'ads_script'=>"required",
        ]);

        Ads::create([
            'ads_type'=>$request->ads_type,
            'ads_script'=>$request->ads_script,
            'on_off'=>$request->on_off,
        ]);
      return redirect()->back()->with('success','stored');
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
        $data=Ads::find($id);
        return view('admin.ads.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->all();
       Ads::where('id',$id)->update([
            'ads_type'=>$request->ads_type,
            'ads_script'=>$request->ads_script,
            'on_off'=>$request->on_off,
        ]);
        return redirect()->back()->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ads::where('id',$id)->delete();
        return back()->with('success','Category Deleted Successfully');
    }
}
