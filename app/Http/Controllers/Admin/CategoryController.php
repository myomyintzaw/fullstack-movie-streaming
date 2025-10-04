<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=category::orderBy('id','desc')
        ->withCount('movie')  //movie is the function name in Category model
        ->paginate(20);
        // dd($data -> toArray());
        return view('admin.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'name'=>'required|unique:categories,name',
            // 'slug'=>'required|unique:categories,slug',
        ]);
        Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),   //needed to use Illuminate\Support\Str;
            // 'slug'=>strtolower(str_replace(' ','-',$request->name)),
        ]);
        // return back()->with('success','Category Created Successfully');
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

        $data=Category::find($id);
        return view('admin.category.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->all();
        $request->validate([
            'name'=>'required|unique:categories,name,'.$id,
            // 'slug'=>'required|unique:categories,slug,'.$id,
        ]);
        // $cat=Category::find($id);
        // $cat->name=$request->name;
        // $cat->slug=Str::slug($request->name);
        // $cat->save();

        // Category::find($id)->update([
        //     'name'=>$request->name,
        //     'slug'=>Str::slug($request->name),
        // ]);
        // return back()->with('success','Category Updated Successfully');

        Category::where('id',$id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->back()->with('success','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $cat=Category::find($id);
        // if(!is_null($cat)){
        //     $cat->delete();
        // }
        // Category::find($id)->delete();
        // Category::destroy($id);
        Category::where('id',$id)->delete();
        return back()->with('success','Category Deleted Successfully');
    }
}
