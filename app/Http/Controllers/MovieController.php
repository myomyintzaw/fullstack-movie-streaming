<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\movie_comment;
use App\Models\MovieLike;
use App\Models\MovieSave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function all()
    {
        $data = Movie::orderBy('id', 'desc');

        //search by title
        if ($search = request()->search) {
            $data->where('name', 'like', "%$search%");
        }


        //search by category
        if ($search_category = request()->category) {
            $findCategory = Category::where('slug', $search_category)->first();
            if (!$findCategory) {
                return redirect('/movie')->with('error', 'data not found');
            }

            $data->whereHas('category', function ($q) use ($findCategory) {
                $q->where('category_movie.category_id', $findCategory->id);
            });
        }

        //by rating
        if ($rating = request()->rating) {
            if ($rating == 'belowfive') {
                $data->where('rating', "<", 5);
            }
            if ($rating == 'abovefive') {
                $data->where('rating', ">", 5);
            }
        }

        $data = $data->paginate(12);
        return view('movie.all', compact('data'));
    }

    public function detail($slug)
    {
        $data = Movie::where('slug', $slug)->with('comment.user', 'category')
            ->withCount('comment', 'like', 'movieSave')
            ->first();
        if (!$data) {
            return redirect('/movie')->with('error', 'data not found');
        }


        // pull relate movie category
        $category = Category::whereHas('movie', function ($q) use ($data) {
            $q->where('category_movie.movie_id', $data->id);
        })->pluck('id');

        $related = Movie::whereHas('category', function ($q) use ($category) {
            $q->whereIn('category_movie.category_id', $category);
        })->where('id', '!=', $data->id) // ✅ exclude the current movie
        ->inRandomOrder()->take(4)->get();

        return view('movie.detail', compact('data', 'related'));
    }



    public function storeComment(Request $request)
    {
        //check auth
        if (!Auth::check()) {
            return 'not auth';
        }

        //
        $created_comment = movie_comment::create([
            'movie_id' => $request->movie_id,
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        $data = movie_comment::where('id', $created_comment->id)->with('user')->first();

        return response()->json($data);
    }

    public function like(Request $request)
    {
        //check auth
        if (!Auth::check()) {
            return 'not auth';
        }
        //check already like
        $checkLike = MovieLike::where('user_id', Auth::id())->where('movie_id', $request->movie_id)->first();
        if ($checkLike) {
            return 'already_like';
        }

        MovieLike::create([
            'movie_id' => $request->movie_id,
            'user_id' => Auth::id(),
        ]);
        return 'success';
    }


    public function saveMovie(Request $request)
    {

        //check auth
        if (!Auth::check()) {
            return 'not auth';
        }
        //check already like
        $checkLike = MovieSave::where('user_id', Auth::id())->where('movie_id', $request->movie_id)->first();
        if ($checkLike) {
            return 'already_save';
        }

        MovieSave::create([
            'movie_id' => $request->movie_id,
            'user_id' => Auth::id(),
        ]);
        return 'success';
    }

    public function getSavedMovies(){
        $data=MovieSave::where('user_id',Auth::id())->with('movie')->orderBy('id','desc')->get();
        return response()->json($data);
    }
}
