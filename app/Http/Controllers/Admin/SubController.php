<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubController extends Controller
{
     public function index()
    {
        $data=Sub::all();
        // dd($data -> toArray());
        return view('admin.sub.index',compact('data'));
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
          'name'=>"required",
          'total_day'=>"required",
          'price'=>"required",
        ]);

        Sub::create([
            'slug'=>Str::slug($request->name),
            'name'=>$request->name,
            'total_day'=>$request->total_day,
            'price'=>$request->price,
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
        $data=Sub::find($id);
        return view('admin.sub.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       Sub::where('id',$id)->update([
            'name'=>$request->name,
            'total_day'=>$request->total_day,
            'price'=>$request->price,
        ]);
        return redirect()->back()->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Sub::where('id',$id)->delete();
        return back()->with('success','Category Deleted Successfully');
    }
}
