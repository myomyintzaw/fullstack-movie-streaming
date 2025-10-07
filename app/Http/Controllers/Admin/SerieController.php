<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Serie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Serie::orderBy('id', 'desc')
            ->with('category')
            ->paginate(10);
        $category = Category::all();
        return view('admin.serie.index', compact('data', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.serie.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return 'nice';

        //validation
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'release_date' => 'required',
            'rating' => 'required',
            'image_url' => 'required',
            'description' => 'required',
            'category.*' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json($v->errors(), 422);
        }

        // return 'nice';
        // movie create
        $created_movie = Serie::create([
            'slug' => Str::slug($request->name),
            'release_date' => $request->release_date,
            'name' => $request->name,
            'image' => $request->image_url,
            'description' => $request->description,
            'rating' => $request->rating,
            'view_count' => 0,
        ]);

        //category sync
        $movie = Serie::find($created_movie->id);
        $movie->category()->sync($request->category);
        return 'success';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Serie::where('id', $id)->with('category')->first();
        $category = Category::all();
        return view('admin.serie.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $id;

        //validation
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'release_date' => 'required',
            'rating' => 'required',
            'image_url' => 'required',
            'description' => 'required',
            'category.*' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json($v->errors(), 422);
        }

        //update movie data
        $movie = Serie::find($id);
        $movie->update([
            'release_date' => $request->release_date,
            'name' => $request->name,
            'image' => $request->image_url,
            'description' => $request->description,
            'rating' => $request->rating,
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
        $data = Serie::find($id);

        //delete category pivot data
        $data->category()->sync([]);

        //delete movie
        $data->delete();
        return redirect()->back()->with('success', 'Serie Deleted Successfully');
    }
}
