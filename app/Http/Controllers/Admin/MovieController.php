<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Movie::orderBy('id','desc')
        ->with('category')
        ->paginate(10);
        $category=Category::all();
        return view('admin.movie.index',compact('data','category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.movie.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // $request->validate([
        //     'name'=>'required',
        //     'release_date'=>'required',
        //     'rating'=>'required',
        //     'image_url'=>'required',
        //     'description'=>'required',
        //     'category_id'=>'required',
        // ]);

        // $movie = new \App\Models\Movie();
        // $movie->name = $request->name;
        // $movie->release_date = $request->release_date;
        // $movie->rating = $request->rating;
        // $movie->image_url = $request->image_url;
        // $movie->description = $request->description;
        // $movie->category_id = $request->category_id;
        // $movie->save();

        //validation
        $v = Validator::make($request->all(), [
            'embed_link' => 'required',
            'name' => 'required',
            'release_date' => 'required',
            'rating' => 'required',
            'image_url' => 'required',
            'description' => 'required',
            'category.*' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json($v->errors(), 422);
            // return response()->json(['status' => 'error', 'errors' => $v->errors()]);
        }

        // movie create
        $created_movie = Movie::create([
            'slug' => Str::slug($request->name),
            'release_date' => $request->release_date,
            'name' => $request->name,
            'image' => $request->image_url,
            'description' => $request->description,
            'embed_link' => $request->embed_link,
             'rating' => $request->rating,
            'view_count' => 0,
        ]);

        //category sync
        $movie = Movie::find($created_movie->id);
        $movie->category()->sync($request->category);
        return 'success';

        // 'slug' => \Str::slug($request->name).'-'.uniqid()
        // 'Str::slug($request->name).'-'.uniqid()'

        // return response()->json(['status' => 'success', 'message' => 'Movie added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Movie::where('id',$id)->with('category')->first();
        $category=Category::all();
        return view('admin.movie.edit',compact('data','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $id;

        //validation
        $v=Validator::make($request->all(),[
            'embed_link'=>'required',
            'name'=>'required',
            'release_date'=>'required',
            'rating'=>'required',
            'image_url'=>'required',
            'description'=>'required',
            'category.*'=>'required',
        ]);

        if($v->fails()){
            return response()->json($v->errors(),422);
        }

        //update movie data
        $movie=Movie::find($id);
        $movie->update([
            'release_date'=>$request->release_date,
            'name'=>$request->name,
            'image'=>$request->image_url,
            'description'=>$request->description,
            'rating'=>$request->rating,
            'embed_link'=>$request->embed_link,
        ]);
        //category sync
        $movie->category()->sync($request->category);
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data=Movie::find($id);

        //delete category pivot data
        $data->category()->sync([]);

        //delete movie
        $data->delete();
        return redirect()->back()->with('success','Movie Deleted Successfully');
    }
}
